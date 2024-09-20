<?php
include '_assets/includes/config.php'; // Pour la connexion à la base de données

if (filter_input(INPUT_POST, 'username') && filter_input(INPUT_POST, 'password'))
{
    $login = $_POST['username'];  // variable login = username rentré par l'utilisateur dans le form
    $mdp = $_POST['password']; // variable mdp = mdp rentré par l'utilisateur dans le form

    $username = 'SELECT couriel FROM tenrac WHERE couriel = $login'; // on récupère le tenrac correspondant au couriel rentré par l'utilisateur
    $password = 'SELECT motdepasse FROM tenrac WHERE couriel = $login'; // on récupère le mot de passe associé

    if ($username === $_POST['username'] && password_verify($_POST['password'], $mdp)) // Si le couriel et mdp correspondent
    {
        echo "Connexion réussie, bienvenue";
        session_start(); // démarrage de la session
        $_SESSION['username'] = $username['couriel'];
        header("Location: ../viewshomepage.php"); // redirection vers la homepage
        exit();
    }
    else // sinon
    {
        echo "Nom d'utilisateur ou mot de passe incorrect";
    }
}

?>