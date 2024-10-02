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
                        Email
                        <input name="mdp" id="mdp" minlength="1" maxlength="100" type="password" placeholder="Enter your password">
                    </label>
                <button class="login-button" type="submit">Se connecter</button>
            </form> 
        </div>
    </div>
</section>