<head>
    <link rel="stylesheet" type="text/css" href="/_assets/styles/login.css">
</head>
<section class="formco" id="login">
    <h1>Connection</h1>
    <form  action='modules/blog/models/loginProcess.php' method="post" class="form_login">
        <div class="yousralapuff">
            <div>
                <label>Email </label>
                <input name="courriel" id="courriel" type="text" maxlength="80" minlength="5"/>
            </div>
            
            <div>
                <label>Mot de passe </label>
                <input name="mdp" id="mdp" type="password" minlength="1" maxlength="100"/></p>
            </div>
            
        </div>
        

        <button type="submit">Connect</button>
    </form> 
</section>
<script src="/_assets/scripts/login.js"></script>