<?php
class Structure {
    private $clubs;

    public function __construct($clubs) {
        $this->clubs = $clubs;
    }

    public function show(): void {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['action']) && $_POST['action'] === 'add') {
                $nom_club = isset($_POST['nom_club']) ? trim($_POST['nom_club']) : '';
                $id_ordre = isset($_POST['id_ordre']) ? trim($_POST['id_ordre']) : '1'; // Valeur par défaut = 1

                if (empty($nom_club) || empty($id_ordre)) {
                    echo '<p class="error-message">Veuillez remplir tous les champs.</p>';
                } else {
                    $this->addClub($nom_club, $id_ordre);
                }
            }

            if (isset($_POST['action']) && $_POST['action'] === 'delete') {
                $id_club = isset($_POST['id_club']) ? trim($_POST['id_club']) : null;
                if (isset($id_club)) {
                    $this->deleteClub($id_club);
                } else {
                    echo '<p class="error-message">Veuillez sélectionner un club à supprimer.</p>';
                }
            }

            if (isset($_POST['action']) && $_POST['action'] === 'edit') {
                $id_club = isset($_POST['id_club']) ? trim($_POST['id_club']) : null;
                $nom_club = isset($_POST['nom_club']) ? trim($_POST['nom_club']) : '';
                $id_ordre = isset($_POST['id_ordre']) ? trim($_POST['id_ordre']) : '1'; // Valeur par défaut = 1

                if (isset($id_club)) {
                    if (!empty($nom_club)) {
                        $this->editClub($id_club, $nom_club, $id_ordre);
                    } else {
                        echo '<p class="error-message">Veuillez remplir tous les champs.</p>';
                    }
                }
            }
        }
        include 'header.php';
        ?>
        <main>
            <div class="clubs">
                <h1>Nos Clubs</h1>
                <table>
                    <thead>
                        <tr>
                            <th>ID Club</th>
                            <th>Nom</th>
                            <th>Ordre</th>
                            <?php if (isset($_SESSION['email'])) { ?>
                            <th>Actions</th>
                            <?php } ?>  
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($this->clubs as $club): ?>
                            <tr>
                                <td><?= htmlspecialchars($club->getIdClub()) ?></td>
                                <td><?= htmlspecialchars($club->getNom()) ?></td>
                                <td>Ordre des Tenrac</td>
                                <?php if (isset($_SESSION['email'])) { ?>
                                <td>
                                    <form method="POST" action="" style="display:inline;">
                                        <input type="hidden" name="action" value="edit">
                                        <input type="hidden" name="id_club" value="<?= htmlspecialchars($club->getIdClub()) ?>">
                                        <input type="text" name="nom_club" value="<?= htmlspecialchars($club->getNom()) ?>" required>
                                        <input type="hidden" name="id_ordre" value="1">
                                        <button type="submit">Modifier</button>
                                    </form>
                                    <form method="POST" action="" style="display:inline;">
                                        <input type="hidden" name="action" value="delete">
                                        <input type="hidden" name="id_club" value="<?= htmlspecialchars($club->getIdClub()) ?>">
                                        <button type="submit">Supprimer</button>
                                    </form>
                                </td>
                                <?php } ?>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?php if(isset($_SESSION['email'])) { ?>
                <div class="add-club">
                    <h2>Ajouter un club</h2>
                    <form method="POST" action="">
                        <input type="hidden" name="action" value="add">
                        <label for="nom_club">Nom du club :</label>
                        <input type="text" id="nom_club" name="nom_club" required>

                        <label for="id_ordre">Ordre :</label>
                        <select id="id_ordre" name="id_ordre" disabled>
                            <option value="1">Ordre des Tenrac</option>
                        </select>

                        <button type="submit">Ajouter</button>
                    </form>
                </div>
                <?php } ?>
            </div>
        </main>
        <?php
    }

    function addClub($nom_club, $id_ordre) {
        $clubDao = new ClubDao(Database::getInstance());

        if ($clubDao->addClub($nom_club, $id_ordre)) {
            echo '<p class="success-message">Le club a été ajouté avec succès !</p>';
            $this->clubs = $clubDao->getLastClubs(10);
        } else {
            echo '<p class="error-message">Erreur lors de l\'ajout du club.</p>';
        }
    }

    private function deleteClub($id_club) {
        $clubDao = new ClubDao(Database::getInstance());

        if ($clubDao->deleteClubById($id_club)) {
            echo '<p class="success-message">Le club a été supprimé avec succès !</p>';
            $this->clubs = $clubDao->getLastClubs(10);
        } else {
            echo '<p class="error-message">Erreur lors de la suppression du club.</p>';
        }
    }

    private function editClub($id_club, $nom_club, $id_ordre) {
        $clubDao = new ClubDao(Database::getInstance());

        if ($clubDao->editClub($id_club, $nom_club, $id_ordre)) {
            echo '<p class="success-message">Le club a été modifié avec succès !</p>';
            $this->clubs = $clubDao->getLastClubs(10);
        } else {
            echo '<p class="error-message">Erreur lors de la modification du club.</p>';
        }
    }
}
?>
