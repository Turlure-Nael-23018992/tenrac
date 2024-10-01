<?php
class Structure {
    private $clubs;

    public function __construct($clubs) {
        $this->clubs = $clubs;
    }

    public function show(): void {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'edit') {
            $this->editClub($_POST['id_club'], $_POST['nom_club'], $_POST['id_ordre']);
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'add') {
            $this->addClub($_POST['nom_club'], $_POST['id_ordre']);
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'delete') {
            $this->deleteClub($_POST['id_club']);
        }

        include 'header.php';
        ?>
        <head>
            <link rel="stylesheet" type="text/css" href="/_assets/styles/structure.css">
            <link rel="stylesheet" type="text/css" href="/_assets/styles/footer.css">
        </head>
        <main class="structure-main">
            <div class="clubs-container">
                <div class="ordre">
                    <h1>Ordre des Tenracs</h1>
                    <img src="_assets/images/ordredestenracs.png" alt="Ordre des Tenracs" />
                </div>
            </div>
            <div class="clubs">
            <?php foreach ($this->clubs as $club): ?>
                <div class="club">
                    <h2><?= htmlspecialchars($club->getNom()) ?></h2>

                    <?php if (isset($_SESSION['email'])): ?>
                        <button class="edit-btn" onclick="openEditForm(<?= htmlspecialchars($club->getIdClub()) ?>, '<?= htmlspecialchars($club->getNom()) ?>')">
                            <ion-icon name="create-outline">Modifier</ion-icon>
                        </button>
                        <button class="delete-btn" onclick="openDeleteForm(<?= htmlspecialchars($club->getIdClub()) ?>)">
                            <ion-icon name="trash-outline">Supprimer</ion-icon>
                        </button>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
        <?php if (isset($_SESSION['email'])): ?>
            <button class="add-btn" onclick="openAddForm()">
                <span>Ajouter un club</span>
            </button>
        <?php endif; ?>

        <div id="addForm" class="add-form">
            <form method="POST" action="">
                <input type="hidden" name="action" value="add">
                <label for="addClubName">Nom du club :</label>
                <input type="text" id="addClubName" name="nom_club" required>
                <input type="hidden" name="id_ordre" value="1">
                <button type="submit">Ajouter</button>
            </form>
        </div>

        <div id="editForm" class="edit-form" style="display:none;">
            <form method="POST" action="">
                <input type="hidden" name="action" value="edit">
                <input type="hidden" id="editClubId" name="id_club">
                <label for="editClubName">Nom du club :</label>
                <input type="text" id="editClubName" name="nom_club" required>
                <input type="hidden" name="id_ordre" value="1">
                <button type="submit">Enregistrer</button>
            </form>
        </div>

        <div id="deleteForm" class="delete-form" style="display:none;">
            <form method="POST" action="">
                <input type="hidden" name="action" value="delete">
                <input type="hidden" id="deleteClubId" name="id_club">
                <p>Êtes-vous sûr de vouloir supprimer ce club ?</p>
                <button type="submit">Supprimer</button>
            </form>
        </div>
        </main>
        <?php include_once 'footer.php'; ?>

        <script>
            function openEditForm(id, name) {
                document.getElementById('editClubId').value = id;
                document.getElementById('editClubName').value = name;
                document.getElementById('editForm').style.display = 'block';
            }

            function openDeleteForm(id) {
                document.getElementById('deleteClubId').value = id;
                document.getElementById('deleteForm').style.display = 'block';
            }

            function openAddForm() {
                if (document.getElementById('addForm').style.display === 'block') {
                    document.getElementById('addForm').style.display = 'none';
                } else {
                    document.getElementById('addForm').style.display = 'block';
                }
            }
        </script>
        <?php
    }

    function addClub($nom_club, $id_ordre) {
        $clubDao = new ClubDao(Database::getInstance());

        if ($clubDao->addClub($nom_club, $id_ordre)) {
            echo <<<HTML
            <p class="success-message">Le club a été ajouté avec succès !</p>
            HTML;
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
