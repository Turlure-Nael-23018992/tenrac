<?php
// Démarrer une session
session_start();

// Inclure le fichier de connexion à la base de données (assurez-vous d'avoir une connexion PDO)
require_once __DIR__ . '/../config/database.php';

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Récupérer les valeurs soumises par le formulaire
    $email = isset($_POST['courriel']) ? trim($_POST['courriel']) : '';
    $password = isset($_POST['mdp']) ? $_POST['mdp'] : '';

    // Vérifier si les champs sont remplis
    if (empty($email) || empty($password)) {
        die('Veuillez remplir tous les champs.');
    }

    // Préparer une requête pour vérifier si l'utilisateur existe
    $query = "SELECT * FROM utilisateurs WHERE courriel = :courriel";
    
    try {
        $stmt = $db->prepare($query);
        $stmt->bindParam(':courriel', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Vérifier si l'utilisateur a été trouvé
        if ($user) {
            // Comparer le mot de passe haché stocké dans la BD avec celui fourni
            if (password_verify($password, $user['mdp'])) {
                // Si les mots de passe correspondent, démarrer une session
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['email'] = $user['courriel'];

                // Rediriger vers la page d'accueil ou tableau de bord
                header('Location: /homepage.php');
                exit();
            } else {
                die('Le mot de passe est incorrect.');
            }
        } else {
            die('Utilisateur non trouvé.');
        }
    } catch (PDOException $e) {
        die("Erreur de base de données : " . $e->getMessage());
    }
}
?>
