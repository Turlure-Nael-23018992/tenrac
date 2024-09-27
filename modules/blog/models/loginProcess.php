<?php
session_start();

require_once __DIR__ . '/../../../_assets/includes/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = isset($_POST['courriel']) ? trim($_POST['courriel']) : '';
    $password = isset($_POST['mdp']) ? $_POST['mdp'] : '';

    if (empty($email) || empty($password)) {
        die('Veuillez remplir tous les champs.');
    }
    $query = "SELECT * FROM Tenrac WHERE couriel = :courriel";
    
    try {
        $stmt = Database::getInstance()->prepare($query);
        $stmt->bindParam(':courriel', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            if (password_verify($password, $user['motdepasse'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['email'] = $user['couriel'];
                //setcookie('co',true,time()+3600000000000000000000);
                header('Location: /?page=dashboard');
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