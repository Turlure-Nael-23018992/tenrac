<?php

$repas = [
    [
        'nom' => 'Petit Déjeuner',
        'horaire' => '08:00 - 09:00',
        "active" => true
    ],
    [
        'nom' => 'Déjeuner',
        'horaire' => '12:00 - 13:30',
        "active" => true
    ],
    [
        'nom' => 'Dîner',
        'horaire' => '19:00 - 21:00',
        "active" => false
    ]
];
?>
<head>
    <link rel="stylesheet" type="text/css" href="/_assets/styles/homepage.css">
    <link rel="stylesheet" type="text/css" href="/_assets/styles/styles.css">
</head>
<?php include 'header.php';  ?>
<main>
    <div class="actualites">
        <h1>Actualités</h1>
        <div class="contCalend">
            <?php foreach ($repas as $repasItem) : ?>
                <div class="calend">
                <?php if ($repasItem['active']) { ?>
                    <span class="sins"></span>
                    <?php  }else { ?>
                        <span class="ins"></span>
                        <?php } ?>
                    <div>
                        <h3><?php echo htmlspecialchars($repasItem['nom']); ?></h3>
                        <p><?php echo htmlspecialchars($repasItem['horaire']); ?></p>
                        <?php if ($repasItem['active']) { ?>
                        <button class="btn-ins">S'inscrire</button>
                        <?php  }else { ?>
                        <button  class="btn-disable" disable>Inscrit</button>
                        <?php }?> 
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <hr>
    </div>
</main>

<script src="/_assets/scripts/homepage.js"></script>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>