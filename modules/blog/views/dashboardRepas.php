<?php
class DashboardRepas { //A METTRE DANS DASHBOARD
    private $repas;

    public function __construct($repas) {
        $this->repas = $repas;
    }

    public function show(): void {
        // Traitement du formulaire d'ajout de repas
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Vérification si c'est le formulaire d'ajout
            if (isset($_POST['action']) && $_POST['action'] === 'add') {
                $adresse = isset($_POST['adresse']) ? trim($_POST['adresse']) : '';
                $date_repas = isset($_POST['date_repas']) ? trim($_POST['date_repas']) : '';
                $id_repas = isset($_POST['id_repas']) ? (int)$_POST['id_repas'] : null;
                $horaire = isset($_POST['horaire']) ? (float)$_POST['horaire'] : null;

                // Vérification des champs
                if (empty($adresse) || empty($date_repas) || is_null($id_repas) || is_null($horaire)) {
                    echo '<p class="error-message">Veuillez remplir tous les champs.</p>';
                } else {
                    $this->addRepas($adresse, $date_repas, $id_repas, $horaire);
                }
            }
            
            // Vérification si c'est le formulaire de suppression
            if (isset($_POST['action']) && $_POST['action'] === 'delete') {
                $adresse = isset($_POST['adresse']) ? trim($_POST['adresse']) : '';
                $id_repas = isset($_POST['id_repas']) ? (int)$_POST['id_repas'] : null;
                $date_repas = isset($_POST['date_repas']) ? trim($_POST['date_repas']) : '';

                if ($adresse && $id_repas && $date_repas) {
                    $this->deleteRepas($adresse, $id_repas, $date_repas);
                } else {
                    echo '<p class="error-message">Veuillez sélectionner un repas à supprimer.</p>';
                }
            }

            // Vérification si c'est le formulaire de modification
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

        ?>
        <main>
            <a href='/?page=dashboard' class="button">Retour au dashboard</a>
            <a href='?page=dashboardClub' class="button">Gérer les clubs</a>
            <a href='?page=dashboardPlat' class="button">Gérer les plats</a>
            <a href='?page=dashboardTenrac' class="button">Gérer les Tenracs</a>
            <div class="repas">
                <h1>Nos Repas</h1>
                <table>
                    <thead>
                        <tr>
                            <th>Adresse</th>
                            <th>Date</th>
                            <th>ID Repas</th>
                            <th>Horaire</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($this->repas as $repas): ?>
                            <tr>
                                <td><?= htmlspecialchars($repas->getAdresse()) ?></td>
                                <td><?= htmlspecialchars($repas->getDateRepas()) ?></td>
                                <td><?= htmlspecialchars($repas->getIdRepas()) ?></td>
                                <td><?= htmlspecialchars($repas->getHoraire()) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

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

                <div class="delete-repas">
                    <h2>Supprimer un repas</h2>
                    <form method="POST" action="">
                        <input type="hidden" name="action" value="delete">
                        <label for="adresse">Adresse du repas à supprimer :</label>
                        <input type="text" id="adresse" name="adresse" required>

                        <label for="id_repas">ID du repas :</label>
                        <input type="number" id="id_repas" name="id_repas" required>

                        <label for="date_repas">Date du repas :</label>
                        <input type="date" id="date_repas" name="date_repas" required>

                        <button type="submit">Supprimer</button>
                    </form>
                </div>

                <div class="edit-repas">
                    <h2>Modifier un repas</h2>
                    <form method="POST" action="">
                        <input type="hidden" name="action" value="edit">
                        <label for="adresse">Adresse du repas à modifier :</label>
                        <input type="text" id="adresse" name="adresse" required>

                        <label for="date_repas">Date du repas :</label>
                        <input type="date" id="date_repas" name="date_repas" required>

                        <label for="id_repas">ID du repas :</label>
                        <input type="number" id="id_repas" name="id_repas" required>

                        <label for="horaire">Horaire :</label>
                        <input type="text" id="horaire" name="horaire" required>

                        <button type="submit">Modifier</button>
                    </form>
                </div>
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

    private function deleteRepas($adresse, $id_repas, $date_repas): void {
        $planningRepasDao = new PlanningRepasDAO(Database::getInstance());

        if ($planningRepasDao->deletePlanningRepas($id_repas)) { // Assurez-vous que vous utilisez l'ID ici
            echo '<p class="success-message">Le repas a été supprimé avec succès !</p>';
            $this->repas = $planningRepasDao->getAllPlanningRepas();
        } else {
            echo '<p class="error-message">Erreur lors de la suppression du repas.</p>';
        }
    }

    private function editRepas($adresse, $date_repas, $id_repas, $horaire): void {
        $planningRepasDao = new PlanningRepasDAO(Database::getInstance());

        if ($planningRepasDao->updatePlanningRepas($id_repas, $adresse, $date_repas, $id_repas, $horaire)) {
            echo '<p class="success-message">Le repas a été modifié avec succès !</p>';
            $this->repas = $planningRepasDao->getAllPlanningRepas();
        } else {
            echo '<p class="error-message">Erreur lors de la modification du repas.</p>';
        }
    }
}
?>
