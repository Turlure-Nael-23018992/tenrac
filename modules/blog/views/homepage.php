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
<?php include_once 'login.php'; ?>
<?php include_once 'header.php';  ?>
<main>
    <div class="actualites">
        <h1>Actualités</h1>
        <div class="contCalend">
            <?php   
            foreach($this->plats as $plat) {
                echo $plat;
            }
            ?>
        </div>
        <hr>
    </div>
</main>

<script src="/_assets/scripts/homepage.js"></script>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
<?php
    }
}
?>