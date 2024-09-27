<?php
class Dashboard{
    private $repas;
    public function __construct($r){
        $this->repas = $r;
    }

    public function show():void{
?>
<head>
    <link rel="stylesheet" type="text/css" href="/_assets/styles/dashboard.css">
    <link rel="stylesheet" type="text/css" href="/_assets/styles/styles.css">
</head>
<?php include_once 'header.php';  ?>




<main>

    <div class="actualites">
        <h1>Actualités</h1>
        <div class="contCalend">
            <?php   
            foreach($this->repas as $rep) {
                echo $rep;
            }
            ?>
        </div>
        <hr>
    </div>
</main>

<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
<?php
    }
}
?>