<?php
include '/../loginProcess.php';
?>

<section class="formco">
    <h1>Connection</h1>
    <form action="action.php" method="post">
        <label>Email </label>
        <input name="courriel" id="courriel" type="text" maxlength="80" minlength="5"/>

        <label>Mot de passe </label>
        <input name="mdp" id="mdp" type="password" minlength="1" maxlength="100"/></p>

        <button type="submit">Connect</button>
    </form> 
</section>
