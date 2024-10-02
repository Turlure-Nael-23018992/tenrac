<?php
class Dashboard{
    private $repas;
    private $club;
    private $tenrac;
    private $plat;
    private $planningList;
    public function __construct($r, $c, $t, $p, $l){
        $this->repas = $r;
        $this->club = $c;
        $this->tenrac = $t;
        $this->plat = $p;
        $this->planningList = $l;
    }
    public function show():void{
        include 'header.php';
        ?>
        <div>
            <h1>Actualités</h1>
            <hr>
        </div>
        
        <h2>Nouvelle Structure</h2>
        <div>
            <?php
            foreach ($this->club as $club) {
                echo '<div>';
                echo "<h1>" . htmlspecialchars($club->getIdClub()) . "</h1>";
                echo "<p>" . htmlspecialchars($club->getNom()) . "</p>";
                echo '</div>';
            } 
            ?>
        </div>
        <h2>Nouveau Plats</h2>
        <div>
            <?php
            foreach ($this->plat as $plat) {
                echo '<div>';
                echo "<h1>" . htmlspecialchars($plat->getIdPlat()) . "</h1>";
                echo "<p>" . htmlspecialchars($plat->getNom()) . "</p>";
                echo '</div>';
            } 
            ?>
        </div>

        <h2>
            Prochain Repas
        </h2>
        <div>
            <?php foreach ($this->planningList as $planning): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($planning->getAdresse()); ?></td>
                        <td><?php echo htmlspecialchars($planning->getDateRepas()); ?></td>
                        <td>
                            <?php 
                                // Récupérer le nom du repas associé au planning
                                foreach ($this->repas as $repas) {
                                    if ($repas->getId() == $planning->getIdRepas()) {
                                        echo htmlspecialchars($repas->getNom());
                                        break;
                                    }
                                }
                            ?>
                        </td>
                        <td><?php echo htmlspecialchars($planning->getHoraire()); ?></td>
                    </tr>
            <?php endforeach; ?>
        </div>

        <h2>Nouveau Tenrac</h2>
        <div>
            <?php
            foreach ($this->tenrac as $tenrac) {
                ?> <div><?php
                 echo htmlspecialchars($tenrac->getNom());
                 echo htmlspecialchars($tenrac->getGrade());
                 echo htmlspecialchars($tenrac->getAdresse());
                ?>
                </div> <?php
            }
            ?>
        </div>
        <?php
    }
}
?>