<?php
include '_assets/includes/config.php'; // Connexion à la base de données

if (filter_input(INPUT_POST, 'username') && filter_input(INPUT_POST, 'password'))
{
    $login = $_POST['username'];
    $mdp = $_POST['password'];

    $username = 'SELECT couriel FROM tenrac WHERE couriel = $login';
    $password = 'SELECT motdepasse FROM tenrac WHERE couriel = $login';

    if ($username === $_POST['username'] && password_verify($_POST['password'], $mdp))
    {
        echo "Connexion réussie, bienvenue";
        session_start();
        $_SESSION['username'] = $username['couriel'];
        header("Location: ../viewshomepage.php");
        exit();
    }
    else
    {
        echo "Nom d'utilisateur ou mot de passe incorrect";
    }
}

?>