<?php

class TenracPage {
    private array $tenracs;

    public function __construct(array $tenracs) {
        $this->tenracs = $tenracs;
    }

    public function show(): void {
        // Traitement du formulaire d'ajout de tenrac
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Vérification si c'est le formulaire d'ajout
            if (isset($_POST['action']) && $_POST['action'] === 'add') {
                $nom = isset($_POST['nom']) ? trim($_POST['nom']) : '';
                $couriel = isset($_POST['couriel']) ? trim($_POST['couriel']) : '';
                $tel = isset($_POST['tel']) ? trim($_POST['tel']) : '';
                $adresse = isset($_POST['adresse']) ? trim($_POST['adresse']) : '';
                $grade = isset($_POST['grade']) ? trim($_POST['grade']) : '';
                $id_club = isset($_POST['id_club']) ? (int)$_POST['id_club'] : 0;
                $id_ordre = isset($_POST['id_ordre']) ? (int)$_POST['id_ordre'] : 0;

                // Vérification des champs
                if (empty($nom) || empty($couriel) || empty($tel) || empty($adresse) || empty($grade)) {
                    echo '<p class="error-message">Veuillez remplir tous les champs.</p>';
                } else {
                    $this->addTenrac($nom, $couriel, $tel, $adresse, $grade, $id_club, $id_ordre);
                }
            }
            
            // Vérification si c'est le formulaire de suppression
            if (isset($_POST['action']) && $_POST['action'] === 'delete') {
                $id_tenrac = isset($_POST['id_tenrac']) ? (int)$_POST['id_tenrac'] : null;

                if ($id_tenrac) {
                    $this->deleteTenrac($id_tenrac);
                } else {
                    echo '<p class="error-message">Veuillez sélectionner un tenrac à supprimer.</p>';
                }
            }

            // Vérification si c'est le formulaire de modification
            if (isset($_POST['action']) && $_POST['action'] === 'edit') {
                $id_tenrac = isset($_POST['id_tenrac']) ? (int)$_POST['id_tenrac'] : null;
                $nom = isset($_POST['nom']) ? trim($_POST['nom']) : '';
                $couriel = isset($_POST['couriel']) ? trim($_POST['couriel']) : '';
                $tel = isset($_POST['tel']) ? trim($_POST['tel']) : '';
                $adresse = isset($_POST['adresse']) ? trim($_POST['adresse']) : '';
                $grade = isset($_POST['grade']) ? trim($_POST['grade']) : '';
                $id_club = isset($_POST['id_club']) ? (int)$_POST['id_club'] : 0;
                $id_ordre = isset($_POST['id_ordre']) ? (int)$_POST['id_ordre'] : 0;

                if ($id_tenrac && !empty($nom)) {
                    $this->editTenrac($id_tenrac, $nom, $couriel, $tel, $adresse, $grade, $id_club, $id_ordre);
                } else {
                    echo '<p class="error-message">Veuillez remplir tous les champs.</p>';
                }
            }
        }
        include 'header.php';
        ?>
        <main>
            <div class="tenracs">
                <h1>Nos Tenracs</h1>
                <table>
                    <thead>
                        <tr>
                            <th>ID Tenrac</th>
                            <th>Nom</th>
                            <th>Couriel</th>
                            <th>Téléphone</th>
                            <th>Adresse</th>
                            <th>Grade</th>
                            <th>ID Club</th>
                            <th>ID Ordre</th>
                            <?php if (isset($_SESSION['email'])) { ?>
                            <th>Actions</th> 
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($this->tenracs as $tenrac): ?>
                            <tr>
                                <td><?= htmlspecialchars($tenrac->getIdTenrac()) ?></td>
                                <td><?= htmlspecialchars($tenrac->getNom()) ?></td>
                                <td><?= htmlspecialchars($tenrac->getCouriel()) ?></td>
                                <td><?= htmlspecialchars($tenrac->getTel()) ?></td>
                                <td><?= htmlspecialchars($tenrac->getAdresse()) ?></td>
                                <td><?= htmlspecialchars($tenrac->getGrade()) ?></td>
                                <td><?= htmlspecialchars($tenrac->getIdClub()) ?></td>
                                <td><?= htmlspecialchars($tenrac->getIdOrdre()) ?></td>
                                <?php if (isset($_SESSION['email'])) { ?>
                                <td>
                                    <form method="POST" action="" style="display:inline;">
                                        <input type="hidden" name="action" value="edit">
                                        <input type="hidden" name="id_tenrac" value="<?= htmlspecialchars($tenrac->getIdTenrac()) ?>">
                                        <input type="text" name="nom" value="<?= htmlspecialchars($tenrac->getNom()) ?>" required>
                                        <input type="email" name="couriel" value="<?= htmlspecialchars($tenrac->getCouriel()) ?>" required>
                                        <input type="text" name="tel" value="<?= htmlspecialchars($tenrac->getTel()) ?>" required>
                                        <input type="text" name="adresse" value="<?= htmlspecialchars($tenrac->getAdresse()) ?>" required>
                                        <input type="text" name="grade" value="<?= htmlspecialchars($tenrac->getGrade()) ?>" required>
                                        <input type="number" name="id_club" value="<?= htmlspecialchars($tenrac->getIdClub()) ?>" required>
                                        <input type="number" name="id_ordre" value="<?= htmlspecialchars($tenrac->getIdOrdre()) ?>" required>
                                        <button type="submit">Modifier</button>
                                    </form>
                                    <form method="POST" action="" style="display:inline;">
                                        <input type="hidden" name="action" value="delete">
                                        <input type="hidden" name="id_tenrac" value="<?= htmlspecialchars($tenrac->getIdTenrac()) ?>">
                                        <button type="submit">Supprimer</button>
                                    </form>
                                </td>
                                <?php } ?>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?php if (isset($_SESSION['email'])) { ?>
                <div class="add-tenrac">
                    <h2>Ajouter un tenrac</h2>
                    <form method="POST" action="">
                        <input type="hidden" name="action" value="add">
                        <label for="nom">Nom du tenrac :</label>
                        <input type="text" id="nom" name="nom" required>

                        <label for="couriel">Couriel :</label>
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
            </div>
        </main>
        <?php
    }

    private function addTenrac($nom, $couriel, $tel, $adresse, $grade, $id_club, $id_ordre) {
        $tenracDao = new TenracDao(Database::getInstance());

        if ($tenracDao->addTenrac($nom, $couriel, $tel, $adresse, $grade, $id_club, $id_ordre)) {
            echo '<p class="success-message">Le tenrac a été ajouté avec succès !</p>';
            $this->tenracs = $tenracDao->getAllTenracs();
        } else {
            echo '<p class="error-message">Erreur lors de l\'ajout du tenrac.</p>';
        }
    }

    private function deleteTenrac($id_tenrac) {
        $tenracDao = new TenracDao(Database::getInstance());

        if ($tenracDao->deleteTenracById($id_tenrac)) {
            echo '<p class="success-message">Le tenrac a été supprimé avec succès !</p>';
            $this->tenracs = $tenracDao->getAllTenracs();
        } else {
            echo '<p class="error-message">Erreur lors de la suppression du tenrac.</p>';
        }
    }

    private function editTenrac($id_tenrac, $nom, $couriel, $tel, $adresse, $grade, $id_club, $id_ordre) {
        $tenracDao = new TenracDao(Database::getInstance());

        if ($tenracDao->editTenrac($id_tenrac, $nom, $couriel, $tel, $adresse, $grade, $id_club, $id_ordre)) {
            echo '<p class="success-message">Le tenrac a été modifié avec succès !</p>';
            $this->tenracs = $tenracDao->getAllTenracs();
        } else {
            echo '<p class="error-message">Erreur lors de la modification du tenrac.</p>';
        }
    }
}
?>
