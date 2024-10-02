<?php
/**
 * Classe RepasPage
 * Cette classe gère l'affichage et la gestion des repas (ajout, suppression, modification).
 */
class RepasPage {
    /**
     * @var array $repas Liste des repas à afficher.
     */
    private $repas;

    /**
     * Constructeur de la classe.
     *
     * @param array $repas Liste des repas initiale.
     */
    public function __construct($repas) {
        $this->repas = $repas;
    }

    /**
     * Affiche la page des repas et traite les formulaires (ajout, modification, suppression).
     *
     * Cette méthode gère l'affichage de la liste des repas et les interactions avec les utilisateurs,
     * comme l'ajout, la modification ou la suppression de repas à travers des formulaires.
     */
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
                $id_repas = isset($_POST['id_repas']) ? (int)$_POST['id_repas'] : null;

                if ($id_repas) {
                    $this->deleteRepas($id_repas);
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
        include 'header.php';
        ?>
        <main>
            <div class="repas">
                <h1>Nos Repas</h1>
                <table>
                    <thead>
                    <tr>
                        <th>Adresse</th>
                        <th>Date</th>
                        <th>ID Repas</th>
                        <th>Horaire</th>
                        <?php if (isset($_SESSION['email'])) { ?>
                            <th>Actions</th>
                        <?php } ?>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($this->repas as $repas): ?>
                        <tr>
                            <td><?= htmlspecialchars($repas->getAdresse()) ?></td>
                            <td><?= htmlspecialchars($repas->getDateRepas()) ?></td>
                            <td><?= htmlspecialchars($repas->getIdRepas()) ?></td>
                            <td><?= htmlspecialchars($repas->getHoraire()) ?></td>
                            <?php if (isset($_SESSION['email'])) { ?>
                                <td>
                                    <form method="POST" action="" style="display:inline;">
                                        <input type="hidden" name="action" value="edit">
                                        <input type="hidden" name="id_repas" value="<?= htmlspecialchars($repas->getIdRepas()) ?>">
                                        <input type="text" name="adresse" value="<?= htmlspecialchars($repas->getAdresse()) ?>" required>
                                        <input type="date" name="date_repas" value="<?= htmlspecialchars($repas->getDateRepas()) ?>" required>
                                        <input type="text" name="horaire" value="<?= htmlspecialchars($repas->getHoraire()) ?>" required>
                                        <button type="submit">Modifier</button>
                                    </form>
                                    <form method="POST" action="" style="display:inline;">
                                        <input type="hidden" name="action" value="delete">
                                        <input type="hidden" name="id_repas" value="<?= htmlspecialchars($repas->getIdRepas()) ?>">
                                        <button type="submit">Supprimer</button>
                                    </form>
                                </td>
                            <?php } ?>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
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

    /**
     * Ajoute un nouveau repas dans la base de données.
     *
     * @param string $adresse Adresse du repas.
     * @param string $date_repas Date du repas (format YYYY-MM-DD).
     * @param int $id_repas ID unique du repas.
     * @param float $horaire Horaire du repas.
     */
    private function addRepas($adresse, $date_repas, $id_repas, $horaire): void {
        $planningRepasDao = new PlanningRepasDAO(Database::getInstance());

        if ($planningRepasDao->addPlanningRepas($adresse, $date_repas, $id_repas, $horaire)) {
            echo '<p class="success-message">Le repas a été ajouté avec succès !</p>';
            $this->repas = $planningRepasDao->getAllPlanningRepas();
        } else {
            echo '<p class="error-message">Erreur lors de l\'ajout du repas.</p>';
        }
    }

    /**
     * Supprime un repas de la base de données.
     *
     * @param int $id_repas ID du repas à supprimer.
     */
    private function deleteRepas($id_repas): void {
        $planningRepasDao = new PlanningRepasDAO(Database::getInstance());

        if ($planningRepasDao->deletePlanningRepas($id_repas)) {
            echo '<p class="success-message">Le repas a été supprimé avec succès !</p>';
            $this->repas = $planningRepasDao->getAllPlanningRepas();
        } else {
            echo '<p class="error-message">Erreur lors de la suppression du repas.</p>';
        }
    }

    /**
     * Modifie un repas existant dans la base de données.
     *
     * @param string $adresse Nouvelle adresse du repas.
     * @param string $date_repas Nouvelle date du repas.
     * @param int $id_repas ID du repas à modifier.
     * @param float $horaire Nouvel horaire du repas.
     */
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
