<?php

/**
 * Classe représentant une page pour la gestion des Tenracs.
 */
class TenracPage {
    /**
     * Liste des tenracs.
     *
     * @var array
     */
    private array $tenracs;

    /**
     * Constructeur de la classe TenracPage.
     *
     * @param array $tenracs Liste initiale des tenracs.
     */
    public function __construct(array $tenracs) {
        $this->tenracs = $tenracs;
    }

    /**
     * Affiche la page des tenracs et traite les formulaires d'ajout, suppression et modification.
     *
     * @return void
     */
    public function show(): void {
        // Traitement des formulaires
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['action']) && $_POST['action'] === 'add') {
                $nom = trim($_POST['nom'] ?? '');
                $couriel = trim($_POST['couriel'] ?? '');
                $tel = trim($_POST['tel'] ?? '');
                $adresse = trim($_POST['adresse'] ?? '');
                $grade = trim($_POST['grade'] ?? '');
                $id_club = (int)($_POST['id_club'] ?? 0);
                $id_ordre = (int)($_POST['id_ordre'] ?? 0);

                if (!empty($nom) && !empty($couriel) && !empty($tel) && !empty($adresse) && !empty($grade)) {
                    $this->addTenrac($nom, $couriel, $tel, $adresse, $grade, $id_club, $id_ordre);
                } else {
                    echo '<p class="error-message">Veuillez remplir tous les champs.</p>';
                }
            }
            if (isset($_POST['action']) && $_POST['action'] === 'delete') {
                $id_tenrac = (int)($_POST['id_tenrac'] ?? null);
                if ($id_tenrac) {
                    $this->deleteTenrac($id_tenrac);
                } else {
                    echo '<p class="error-message">Veuillez sélectionner un tenrac à supprimer.</p>';
                }
            }
            if (isset($_POST['action']) && $_POST['action'] === 'edit') {
                $id_tenrac = (int)($_POST['id_tenrac'] ?? null);
                $nom = trim($_POST['nom'] ?? '');
                $couriel = trim($_POST['couriel'] ?? '');
                $tel = trim($_POST['tel'] ?? '');
                $adresse = trim($_POST['adresse'] ?? '');
                $grade = trim($_POST['grade'] ?? '');
                $id_club = (int)($_POST['id_club'] ?? 0);
                $id_ordre = (int)($_POST['id_ordre'] ?? 0);

                if ($id_tenrac && !empty($nom)) {
                    $this->editTenrac($id_tenrac, $nom, $couriel, $tel, $adresse, $grade, $id_club, $id_ordre);
                } else {
                    echo '<p class="error-message">Veuillez remplir tous les champs.</p>';
                }
            }
        }

        include 'header.php';

        // Affichage du contenu
        ?>
        <main>
            <div class="tenracs-container">
                <h1>Nos Tenracs</h1>
                <div class="cards">
                    <?php foreach ($this->tenracs as $tenrac): ?>
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
                            <?php if (isset($_SESSION['email'])) { ?>
                                <div class="card-footer">
                                    <form method="POST" action="" style="display:inline;">
                                        <input type="hidden" name="action" value="edit">
                                        <input type="hidden" name="id_tenrac" value="<?= htmlspecialchars($tenrac->getIdTenrac()) ?>">
                                        <button type="submit" class="edit-btn">Modifier</button>
                                    </form>
                                    <form method="POST" action="" style="display:inline;">
                                        <input type="hidden" name="action" value="delete">
                                        <input type="hidden" name="id_tenrac" value="<?= htmlspecialchars($tenrac->getIdTenrac()) ?>">
                                        <button type="submit" class="delete-btn">Supprimer</button>
                                    </form>
                                </div>
                            <?php } ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php if (isset($_SESSION['email'])) { ?>
                <div class="add-tenrac-form">
                    <h2>Ajouter un Tenrac</h2>
                    <form method="POST" action="">
                        <input type="hidden" name="action" value="add">
                        <label for="nom">Nom du Tenrac :</label>
                        <input type="text" id="nom" name="nom" required>

                        <label for="couriel">Courriel :</label>
                        <input type="email" id="couriel" name="couriel" required>

                        <label for="tel">Téléphone :</label>
                        <input type="text" id="tel" name="tel" required>

                        <label for="adresse">Adresse :</label>
                        <input type="text" id="adresse" name="adresse" required>

                        <label for="grade">Grade :</label>
                        <input type="text" id="grade" name="grade" required>

                        <label for="id_club">ID Club :</label>
                        <input type="number" id="id_club" name="id_club" required>

                        <label for="id_ordre">ID Ordre :</label>
                        <input type="number" id="id_ordre" name="id_ordre" required>

                        <button type="submit">Ajouter</button>
                    </form>
                </div>
            <?php } ?>
        </main>
        <?php include_once 'footer.php' ?>
        <?php
    }

    /**
     * Ajoute un tenrac à la base de données.
     *
     * @param string $nom Le nom du Tenrac.
     * @param string $couriel Le courriel du Tenrac.
     * @param string $tel Le téléphone du Tenrac.
     * @param string $adresse L'adresse du Tenrac.
     * @param string $grade Le grade du Tenrac.
     * @param int $id_club L'identifiant du club du Tenrac.
     * @param int $id_ordre L'identifiant de l'ordre du Tenrac.
     *
     * @return void
     */
    private function addTenrac($nom, $couriel, $tel, $adresse, $grade, $id_club, $id_ordre) {
        $tenracDao = new TenracDao(Database::getInstance());

        if ($tenracDao->addTenrac($nom, $couriel, $tel, $adresse, $grade, $id_club, $id_ordre)) {
            echo '<p class="success-message">Le tenrac a été ajouté avec succès !</p>';
            $this->tenracs = $tenracDao->getAllTenracs();
        } else {
            echo '<p class="error-message">Erreur lors de l\'ajout du tenrac.</p>';
        }
    }

    /**
     * Supprime un tenrac de la base de données.
     *
     * @param int $id_tenrac L'identifiant du Tenrac à supprimer.
     *
     * @return void
     */
    private function deleteTenrac($id_tenrac) {
        $tenracDao = new TenracDao(Database::getInstance());

        if ($tenracDao->deleteTenracById($id_tenrac)) {
            echo '<p class="success-message">Le tenrac a été supprimé avec succès !</p>';
            $this->tenracs = $tenracDao->getAllTenracs();
        } else {
            echo '<p class="error-message">Erreur lors de la suppression du tenrac.</p>';
        }
    }

    /**
     * Modifie un tenrac existant dans la base de données.
     *
     * @param int $id_tenrac L'identifiant du Tenrac.
     * @param string $nom Le nom du Tenrac.
     * @param string $couriel Le courriel du Tenrac.
     * @param string $tel Le téléphone du Tenrac.
     * @param string $adresse L'adresse du Tenrac.
     * @param string $grade Le grade du Tenrac.
     * @param int $id_club L'identifiant du club.**/
