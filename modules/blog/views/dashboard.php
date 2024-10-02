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
        <main class="dashboard-main">
            <section class="dashboard-actu">
                    <h1>Actualités</h1>
            </section>
            
            <h2>Nouvelle Structure</h2>
            <div class="clubs">
            <?php foreach ($this->club as $club): ?>
                <div class="club">
                    <h2><?= htmlspecialchars($club->getNom()) ?></h2>
                </div>
            <?php endforeach; ?>
            </div>
            <h2>Nouveau Plats</h2>
            <div class="clubs">
                <?php foreach ($this->plat as $plat): ?>
                    <div class="club">
                        <h2><?= htmlspecialchars($plat->getNom()) ?></h2>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Pas forcement besoin car dans la page repas on les vois clairement <h2>
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
            </div> -->

            <h2>Nouveau Tenrac</h2>
            <div>
            <div class="cards">
                    <?php foreach ($this->tenrac as $tenrac): ?>
                        <div class="card">
                            <div class="card-header">
                                <h2><?= htmlspecialchars($tenrac->getNom()) ?></h2>
                            </div>
                            <div class="card-body">
                                <p><strong>Email :</strong> <?= htmlspecialchars($tenrac->getCouriel()) ?></p>
                                <p><strong>Téléphone :</strong> <?= htmlspecialchars($tenrac->getTel()) ?></p>
                                <p><strong>Adresse :</strong> <?= htmlspecialchars($tenrac->getAdresse()) ?></p>
                                <p><strong>Grade :</strong> <?= htmlspecialchars($tenrac->getGrade()) ?></p>
                            </div>
                            
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            </main>
        <?php include 'footer.php';
    }
}
?>