<?php
class Homepage{
    private $plats;
    public function __construct($p){
        $this->plats = $p;
    }

    public function show():void{
?>
<head>
    <link rel="stylesheet" type="text/css" href="/_assets/styles/homepage.css">
    <link rel="stylesheet" type="text/css" href="/_assets/styles/styles.css">
</head>
<body>
<?php include_once 'header.php';  ?>
<main>
    <section class="presentation-container">
        <div class="text-container">
            <h1>Bienvenue dans l'Ordre des Tenracs</h1> 🧀🍗<br><br>
            <p>Plongez dans l'univers <strong>savoureux</strong> et <strong>convivial</strong> de l'Ordre des Tenracs, où la passion pour les tenders de poulet à la raclette 🧀🍗 est célébrée à chaque instant. <br>Que vous soyez un <strong>novice curieux</strong> ou un <strong>grand maître</strong> 🏅 de notre tradition, notre site vitrine met en lumière les clubs tenracs à travers le territoire 🗺️ et les repas secrets 🕵️‍♂️ qui réunissent nos membres autour de plats uniques et délicieux 😋.</p>
        </div>
        <img src="https://placehold.co/500x300" alt="tenrac">
    </section>
    <section class="second-presentation-container">
        <img src="https://placehold.co/500x300" alt="tenrac2">
        <div class="second-text-container">
            <br><br><h2>Découvrez nos activités</h2> :<br>
                <p>- Rejoignez l'Ordre et explorez nos clubs de tenracs 🤝, leur histoire 📜 et leur mission.<br>
                - Participez à des repas exclusifs 🍽️ où chaque plat à base de raclette est un hommage à notre amour pour la gastronomie généreuse 🤤.<br>
                - Explorez nos événements à venir 📅 et plongez dans une aventure culinaire 🧀 sans précédent.<br>
                Chaque repas est l’occasion de savourer des <strong>plats originaux</strong> à base de raclette, accompagnés des <strong>ingrédients les plus surprenants</strong> 🤯, dans une ambiance chaleureuse 🔥 et fraternelle 🤗.<br>
                <br><strong>Bienvenue chez les Tenracs</strong> 🎉, où la passion de la raclette 🧀 rencontre la convivialité !</p>
        </div>
    </section>
    <section class="t"></section>
</main>
</body>
<script src="/_assets/scripts/homepage.js"></script>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
<?php
    }
}
?>