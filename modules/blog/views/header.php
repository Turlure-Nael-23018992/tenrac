<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Tenrac</title>
    <meta charset="UTF-8">
    <meta name="description" content="Tenrac">
    <meta name="viewport" 
        content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/_assets/styles/styles.css">
    <link rel="stylesheet" type="text/css" href="/_assets/styles/header.css">
    <link rel="stylesheet" type="text/css" href="/_assets/styles/footer.css">
    <link rel="stylesheet" type="text/css" href="/_assets/styles/login.css">
    <link rel="stylesheet" type="text/css" href="/_assets/styles/homepage.css">

    <?php if (isset($_GET['page']) && $_GET['page'] === 'structure') { ?>
        <link rel="stylesheet" type="text/css" href="/_assets/styles/structure.css">
    <?php } ?>
    <?php if (isset($_GET['page']) && $_GET['page'] === 'repas') { ?>
        <link rel="stylesheet" type="text/css" href="/_assets/styles/repas.css">
    <?php } ?>
    <?php if (isset($_GET['page']) && $_GET['page'] === 'dashboard') { ?>
        <link rel="stylesheet" type="text/css" href="/_assets/styles/structure.css">
        <link rel="stylesheet" type="text/css" href="/_assets/styles/tenrac.css">
        <link rel="stylesheet" type="text/css" href="/_assets/styles/dashboard.css">
    <?php } ?>
    <?php if (isset($_GET['page']) && $_GET['page'] === 'tenrac') { ?>
        <link rel="stylesheet" type="text/css" href="/_assets/styles/tenrac.css">
    <?php } ?>
    <?php if (isset($_GET['page']) && $_GET['page'] === 'plats') { ?>
        <link rel="stylesheet" type="text/css" href="/_assets/styles/structure.css">
    <?php } ?>

    <link rel="icon" type="image/png" href="/_assets/images/icons/icon.ico">
</head>
<header class="header">
    <?php if(isset($_SESSION['email'])) { ?>
        <a href="/?page=dashboard">
    <?php } else {?>
        <a href="/">
    <?php } ?>
        <div class="logo"></div>
    </a>
    <nav>
        <ul>
            <li><a href="/?page=structure">Structure</a></li>
            <li><a href="/?page=plats">Plats</a></li>
            <li><a href="/?page=repas">Repas</a></li>
            <li><a href="/?page=tenrac">Tenrac</a></li>
        </ul>
    </nav>
    <div>
        <?php 
        if (isset($_SESSION['email'])) {
        ?>
        <form method="POST" action="/_assets/includes/logout.php">
            <button type="submit" class="logout-button">
                <ion-icon name="log-out-outline">Se déconnecter</ion-icon> 
            </button>
        </form>
        <?php } else { ?>
            <button onclick="popup()" id="toggleButton">
                <ion-icon name="log-in-outline">Se déconnecter</ion-icon> 
            </button>
        <?php } ?>
    </div>
</header>
<div class="sub-header">
    <svg class="wave"  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
        <path fill="#ffffff" fill-opacity="1" d="M0,128L80,133.3C160,139,320,149,480,144C640,139,800,117,960,117.3C1120,117,1280,139,1360,149.3L1440,160L1440,320L1360,320C1280,320,1120,320,960,320C800,320,640,320,480,320C320,320,160,320,80,320L0,320Z"></path>
    </svg>
</div>  
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

<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>