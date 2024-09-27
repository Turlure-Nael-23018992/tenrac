<?php
session_start(); 
// Vérifier si l'utilisateur est bien connecté
if (isset($_SESSION['email'])) {
    // Supprimer toutes les variables de session
    session_unset();
    // Détruire la session
    session_destroy();
}

// Rediriger l'utilisateur vers la page de connexion ou d'accueil après déconnexion
header('Location: /?page=homepage'); // Changez 'login.php' par l'URL de votre page de connexion
exit();
?>