<?php
class RepasPage { 
    private $repas;

    public function __construct($repas) {
        $this->repas = $repas;
    }

    public function show(): void {
        // Traitement du formulaire d'ajout de repas
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['action']) && $_POST['action'] === 'add') {
                $adresse = isset($_POST['adresse']) ? trim($_POST['adresse']) : '';
                $date_repas = isset($_POST['date_repas']) ? trim($_POST['date_repas']) : '';
                $id_repas = isset($_POST['id_repas']) ? (int)$_POST['id_repas'] : null;
                $horaire = isset($_POST['horaire']) ? (float)$_POST['horaire'] : null;

                if (empty($adresse) || empty($date_repas) || is_null($id_repas) || is_null($horaire)) {
                    echo '<p class="error-message">Veuillez remplir tous les champs.</p>';
                } else {
                    $this->addRepas($adresse, $date_repas, $id_repas, $horaire);
                }
            }

            if (isset($_POST['action']) && $_POST['action'] === 'delete') {
                $id_repas = isset($_POST['id_repas']) ? (int)$_POST['id_repas'] : null;

                if ($id_repas) {
                    $this->deleteRepas($id_repas);
                } else {
                    echo '<p class="error-message">Veuillez sélectionner un repas à supprimer.</p>';
                }
            }

            if (isset($_POST['action']) && $_POST['action'] === 'edit') {
                $adresse = isset($_POST['adresse']) ? trim($_POST['adresse']) : '';
                $date_repas = isset($_POST['date_repas']) ? trim($_POST['date_repas']) : '';
                $id_repas = isset($_POST['id_repas']) ? (int)$_POST['id_repas'] : null;
                $horaire = isset($_POST['horaire']) ? (float)$_POST['horaire'] : null;

                if ($adresse && $id_repas && $date_repas) {
                    $this->editRepas($adresse, $date_repas, $id_repas, $horaire);
                } else {
                    echo '<p class="error-message">Veuillez remplir tous les champs.</p>';
                }
            }
        }
        include 'header.php';
        ?>
        <head>
            <link rel="stylesheet" href="_assets/styles/repas.css">
        </head>
        <main>
            <div class="repas-calendar">
                <h1>Planning des Repas</h1>
                <div class="calendar">
                    <?php
                    $daysOfWeek = ['Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam', 'Dim'];
                    foreach ($daysOfWeek as $day) {
                        echo "<div class='calendar-day'>$day</div>";
                    }

                    foreach ($this->repas as $repas) {
                        $day = date('N', strtotime($repas->getDateRepas())) - 1;
                        echo "<div class='calendar-item' style='grid-column-start: " . ($day + 1) . ";'>";
                        echo "<p>{$repas->getAdresse()}</p>";
                        echo "<p>{$repas->getDateRepas()} - {$repas->getHoraire()}h</p>";
                        echo "</div>";
                    }
                    ?>
                </div>

                <?php if (isset($_SESSION['email'])) { ?>
                <div class="add-repas">
                    <h2>Ajouter un repas</h2>
                    <form method="POST" action="">
                        <input type="hidden" name="action" value="add">
                        <label for="adresse">Adresse :</label>
                        <input type="text" id="adresse" name="adresse" required>

                        <label for="date_repas">Date du repas :</label>
                        <input type="date" id="date_repas" name="date_repas" required>

                        <label for="id_repas">ID du repas :</label>
                        <input type="number" id="id_repas" name="id_repas" required>

                        <label for="horaire">Horaire :</label>
                        <input type="text" id="horaire" name="horaire" required>

                        <button type="submit">Ajouter</button>
                    </form>
                </div>
                <?php } ?>
            </div>
        </main>
        <?php
    }

    private function addRepas($adresse, $date_repas, $id_repas, $horaire): void {
        $planningRepasDao = new PlanningRepasDAO(Database::getInstance());

        if ($planningRepasDao->addPlanningRepas($adresse, $date_repas, $id_repas, $horaire)) {
            echo '<p class="success-message">Le repas a été ajouté avec succès !</p>';
            $this->repas = $planningRepasDao->getAllPlanningRepas();
        } else {
            echo '<p class="error-message">Erreur lors de l\'ajout du repas.</p>';
        }
    }

    private function deleteRepas($id_repas): void {
        $planningRepasDao = new PlanningRepasDAO(Database::getInstance());

        if ($planningRepasDao->deletePlanningRepas($id_repas)) {
            echo '<p class="success-message">Le repas a été supprimé avec succès !</p>';
            $this->repas = $planningRepasDao->getAllPlanningRepas();
        } else {
            echo '<p class="error-message">Erreur lors de la suppression du repas.</p>';
        }
    }

    private function editRepas($adresse, $date_repas, $id_repas, $horaire): void {
        $planningRepasDao = new PlanningRepasDAO(Database::getInstance());

        if ($planningRepasDao->updatePlanningRepas($id_repas, $adresse, $date_repas, $horaire)) {
            echo '<p class="success-message">Le repas a été modifié avec succès !</p>';
            $this->repas = $planningRepasDao->getAllPlanningRepas();
        } else {
            echo '<p class="error-message">Erreur lors de la modification du repas.</p>';
        }
    }
}
?>