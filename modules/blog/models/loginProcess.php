<?php
session_start();

require_once __DIR__ . '/../../../_assets/includes/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = isset($_POST['courriel']) ? trim($_POST['courriel']) : '';
    $password = isset($_POST['mdp']) ? $_POST['mdp'] : '';

    if (empty($email) || empty($password)) {
        echo "<script>alert('Veuillez remplir tous les champs.'); window.history.back();</script>";
        exit;
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
                header('Location: /?page=dashboard');
                exit;
            } else {
                echo "<script>alert('Mot de passe ou email invalide'); window.history.back();</script>";
                exit;
            }
        } else {
            echo "<script>alert('Utilisateur non trouvé.'); window.history.back();</script>";
            exit;
        }
    } catch (PDOException $e) {
        echo "<script>alert('Erreur de base de données : " . addslashes($e->getMessage()) . "'); window.history.back();</script>";
        exit;
    }
}
?>