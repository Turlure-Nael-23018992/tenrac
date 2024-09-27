<?php
class PlatPage {
    private $plats;

    public function __construct($plats) {
        $this->plats = $plats;
    }

    public function show(): void {
?>
<head>
    <link rel="stylesheet" type="text/css" href="/_assets/styles/homepage.css">
    <link rel="stylesheet" type="text/css" href="/_assets/styles/styles.css">
</head>
<?php include_once 'header.php';  ?>
<main>
<div class="plats">
        <h1>Nos Plats</h1>
        
        <!-- Ajouter un plat -->
        <div class="add-plat">
            <h2>Ajouter un plat</h2>
            <form method="POST" action="modules/blog/controllers/PlatController.php?action=addPlat">
                <input type="text" name="nom_plat" placeholder="Nom du plat" required>
                <button type="submit">Ajouter</button>
            </form>
        </div>

        <div class="contPlats">
            <?php   
            foreach($this->plats as $plat) {
                ?>
                <div class="plat">
                    <h2><?php echo htmlspecialchars($plat->getNom()); ?></h2>
                    
                    <!-- Lien vers les détails du plat -->
                    <a href="/plat/detail/<?php echo $plat->getId(); ?>" class="plat-link">Voir les détails</a>

                    <!-- Modifier le plat -->
                    <form method="POST" action="/models/Plat/PlatDao">
                        <input type="hidden" name="id_plat" value="<?php echo $plat->getId(); ?>">
                        <input type="text" name="nom_plat" value="<?php echo htmlspecialchars($plat->getNom()); ?>" required>
                        <button type="submit">Modifier</button>
                    </form>

                    <!-- Supprimer le plat -->
                    <form method="POST" action="/models/Plat/PlatDao">
                        <input type="hidden" name="id_plat" value="<?php echo $plat->getId(); ?>">
                        <button type="submit" class="delete-btn">Supprimer</button>
                    </form>
                </div>
                <?php
            }
            ?>
        </div>
        <hr>
    </div>
</main>

<script src="/_assets/scripts/plat.js"></script>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
<?php
    }
}
?>