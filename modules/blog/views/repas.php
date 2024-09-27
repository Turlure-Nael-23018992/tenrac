<?php
class RepasPage{
    private $repas;
    public function __construct($re){
        $this->repas = $re;
    }

    public function show():void{
?>
<head>
    <link rel="stylesheet" type="text/css" href="/_assets/styles/structure.css">
    <link rel="stylesheet" type="text/css" href="/_assets/styles/styles.css">
</head>
<?php include 'header.php'; ?>
<main>
      <div class="repas">
        <h1>Les Repas de la semaine</h1>
        <ul>
                    <?php foreach ($this->repas as $repas) { ?>
                        <li><?php echo htmlspecialchars($repas); ?></li>
                    <?php } ?>
                </ul>
      </div>  

      <div class="ajout_repas">

      </div>
</main>
<script src="/_assets/scripts/homepage.js"></script>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
<?php
    }}
?>