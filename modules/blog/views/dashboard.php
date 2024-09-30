<?php
class Dashboard{
    private $repas;
    public function __construct($r){
        $this->repas = $r;
    }
    public function show():void{
        include 'header.php';
        foreach ($this->repas as $repas) {
            echo "<div>";
            echo "<h1>" . htmlspecialchars($repas->getId()) . "</h1>";
            echo "<p>" . htmlspecialchars($repas->getNom()) . "</p>";
            echo "</div>";
        }
        ?>
        <h1>Actualitées</h1>
        <?php
    }
}
?>