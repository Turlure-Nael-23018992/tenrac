<?php
    session_start();
?>
<head>
    <link rel="stylesheet" type="text/css" href="/_assets/styles/header.css">
</head>
<header class="header">
    <a href="/">
        <div class="logo"></div>
    </a>
    <nav>
        <ul>
            <li><a href="/?page=structure">Structure</a></li>
            <li><a href="/?page=plats">Plats</a></li>
        </ul>
    </nav>
    <div>
        <?php 
        if (isset($_SESSION['email'])) {
        ?>
        <form method="POST" action="/_assets/includes/logout.php">
            <button type="submit" class="logout-button">
                <ion-icon name="log-out-outline"></ion-icon> Se déconnecter
            </button>
        </form>
        <?php } else { ?>
            <button onclick="popup()" id="toggleButton">
                Se Connecter
            </button>
        <?php } ?>
    </div>
</header>
<section class="sub-header">
    <svg class="wave"  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
        <path fill="#ffffff" fill-opacity="1" d="M0,128L80,133.3C160,139,320,149,480,144C640,139,800,117,960,117.3C1120,117,1280,139,1360,149.3L1440,160L1440,320L1360,320C1280,320,1120,320,960,320C800,320,640,320,480,320C320,320,160,320,80,320L0,320Z"></path>
    </svg>
</section>  
<div id="cont_login">
    <?php include_once 'login.php'; ?>
</div>
<script>

    let header = document.querySelector("header")

    document.addEventListener("scroll", () => {
        header.classList.toggle("sticky", window.scrollY > 0)
    })

    window.addEventListener('scroll', function () {
        const scrollPosition = window.scrollY;
        const maxScroll = document.body.scrollHeight - window.innerHeight; 

        const angle = 171 + (scrollPosition / maxScroll) * 360 / 6;

        document.querySelector('.header').style.background = `linear-gradient(${angle}deg, rgba(194,49,21,1) 0%, rgba(85,16,39,1) 100%)`;
    });
</script>