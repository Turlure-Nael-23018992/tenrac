
<section class="formco-container">
    <div class="formco" id="login">
        <div class="logo-login-container">
            <img src="/_assets/images/icons/icon.png" alt="logo" class="logo-login">
            <h1>Se connecter</h1>
        </div>
        <div class="form-container">
            <form action='modules/blog/models/loginProcess.php' method="post" class="form_login">
                <label>
                    Email :
                    <input type="email" id="courriel" name="courriel" maxlength="80" placeholder="Entrez votre email">
                </label>
                <label>
                    Mot de passe :
                    <input name="mdp" id="mdp" minlength="1" maxlength="100" type="password" placeholder="Entrez votre mot de passe">
                </label>
                <button class="login-button" type="submit">Se connecter</button>
            </form>

            <?php if (isset($_SESSION['error'])): ?>
                <div class="error-message" style="color: red;">
                    <?= htmlspecialchars($_SESSION['error']); ?>
                </div>
                <?php unset($_SESSION['error']); // Supprime le message d'erreur après l'affichage ?>
            <?php endif; ?>
        </div>
    </div>
</section>
<script src="/_assets/scripts/login.js"></script>