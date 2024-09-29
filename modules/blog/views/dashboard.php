<?php
class Dashboard{
    private $repas;
    public function __construct($r){
        $this->repas = $r;
    }
    public function show():void{
        echo 'bienvenue sur le dashboard';?>
        <a href='/?page=dashboardPlat' class="button">aller voir les plats</a><?php
        foreach ($this->repas as $repas) {
            echo "<div>";
            echo "<h1>" . htmlspecialchars($repas->getId()) . "</h1>";
            echo "<p>" . htmlspecialchars($repas->getNom()) . "</p>";
            echo "</div>";
        }
    }
}
?>