<?php
include '_assets/includes/config.php'; // Pour la connexion à la base de données

if (filter_input(INPUT_POST, 'username') && filter_input(INPUT_POST, 'password'))
{
    $login = $_POST['courriel'];  // variable login = username rentré par l'utilisateur dans le form
    $mdp = $_POST['mdp']; // variable mdp = mdp rentré par l'utilisateur dans le form

    $password = 'SELECT motdepasse FROM tenrac WHERE courriel = $login'; // on récupère le mot de passe associé

    if ($username === $_POST['courriel'] && password_verify($_POST['mdp'], $mdp)) // Si le couriel et mdp correspondent
    {
        session_start(); // démarrage de la session
        $_SESSION['username'] = $username['couriel'];
        setcookie('IsCo', true, time() + 3600);
        header("Location: ../views/homepage.php"); // redirection vers la homepage
        exit();
    }
    else // sinon
    {
        echo "Nom d'utilisateur ou mot de passe incorrect";
    }
}

?>