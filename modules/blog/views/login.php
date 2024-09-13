<?php
include '_assets/config/config.php';

?>

<!DOCTYPE html>

<html lang="fr">
    <head>
        <title>Login</title>
    </head>
    <form>
        <div>
            <label for='username'>Utilisateur : </label>
            <input type="text" name="username" required></input>
        </div>
        <div>
            <label for='password'>Mot de passe : </label>
            <input type="password" name="password" required></input>
        </div>
        <button type="submit">Se connecter</button>
    </form>
</html>