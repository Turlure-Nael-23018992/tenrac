<?php

class PlatPage {
    private $plats;
    private $platDao;

    public function __construct($plats, $platDao) {
        $this->plats = $plats;
        $this->platDao = $platDao;
    }

    public function show(): void {
        $platsTrouves = [];
        $ingredientTrouves = [];
        $searchTerm = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['search'])) {
                $searchTerm = $_POST['search'];
                $platsTrouves = $this->getPlatsParIngredients([$searchTerm]);
            }

            if (isset($_POST['action'])) {
                switch ($_POST['action']) {
                    case 'add':
                        $nom_plat = trim($_POST['nom_plat'] ?? '');
                        $lien_imageP = trim($_POST['lien_imageP'] ?? null);
                        if (!empty($nom_plat)) {
                            $this->addPlat($nom_plat, $lien_imageP);
                        }
                        break;

                    case 'infoingre':
                        $id_plat = trim($_POST['id_plat'] ?? null);
                        if ($id_plat) {
                            $ingredientTrouves = $this->getIngredientByIdPlat($id_plat);
                        }
                        break;

                    case 'delete':
                        $id_plat = trim($_POST['id_plat'] ?? null);
                        if ($id_plat) {
                            $this->deletePlat($id_plat);
                        }
                        break;

                    case 'edit':
                        $id_plat = trim($_POST['id_plat'] ?? null);
                        $nom_plat = trim($_POST['nom_plat'] ?? '');
                        $lien_imageP = trim($_POST['lien_imageP'] ?? null);
                        if ($id_plat && !empty($nom_plat)) {
                            $this->editPlat($id_plat, $nom_plat, $lien_imageP);
                        }
                        break;
                }
            }
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
                    <h1>Les plats</h1>
                    <img src="_assets/images/icons/subheader.jpg" alt="Ordre des Tenracs" />
                </div>
            </div>
            <div class="clubs">
                <?php foreach ($this->plats as $plat): ?>
                    <div class="club">
                        <h2><?= htmlspecialchars($plat->getNom()) ?></h2>

                        <?php if (isset($_SESSION['email'])): ?>
                            <button class="edit-btn" onclick="openEditForm(<?= htmlspecialchars($plat->getIdPlat()) ?>, '<?= htmlspecialchars($plat->getNom()) ?>')">
                                <ion-icon name="create-outline">Modifier</ion-icon>
                            </button>
                            <button class="delete-btn" onclick="openDeleteForm(<?= htmlspecialchars($plat->getIdPlat()) ?>)">
                                <ion-icon name="trash-outline">Supprimer</ion-icon>
                            </button>
                        <?php endif; ?>
                        <!-- Formulaire de visualisation des ingrédients -->
                        <form method="POST" action="" class="infoingre">
                            <input type="hidden" name="action" value="infoingre">
                            <input type="hidden" name="id_plat" value="<?= htmlspecialchars($plat->getIdPlat()) ?>">
                            <button type="submit">i</button>
                        </form>
                    </div>
                <?php endforeach; ?>
            </div>
            <?php if (isset($_SESSION['email'])): ?>
                <button class="add-btn" onclick="openAddForm()">
                    <span>Ajouter un plat</span>
                </button>
                <div>
                    <form action="" method="post">
                        <input type="search" name="search" placeholder="Rechercher un plat">
                        <button type="submit">Rechercher</button>
                    </form>
                    <div id="plat-rechercher">
                        <?php
                        if (!empty($platsTrouves)) {
                            echo '<h2>Résultats de la recherche pour "' . htmlspecialchars($searchTerm) . '"</h2>';
                            foreach ($platsTrouves as $plat) {
                                echo '<div class="plat">';
                                echo '<h3>' . htmlspecialchars($plat->getNom()) . '</h3>';
                                echo '</div>';
                            }
                        } else {
                            echo '<p>Aucun plat trouvé pour "' . htmlspecialchars($searchTerm) . '"</p>';
                        }
                        ?>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Affichage des ingrédients s'ils sont disponibles -->
            <div id="ingredient-container">
                <?php if (!empty($ingredientTrouves)): ?>
                    <h3>Ingrédients du plat sélectionné :</h3>
                    <div>
                        <?php foreach ($ingredientTrouves as $ingredient): ?>
                            <p><?= htmlspecialchars($ingredient->getNom()) ?></p>
                        <?php endforeach; ?>
                        </div>
                <?php else: ?>
                    <p>Aucun ingrédient trouvé pour ce plat.</p>
                <?php endif; ?>
            </div>

        </main>

        <?php include_once "footer.php"; ?>
        <script>
            function openEditForm(id, name) {
                document.getElementById('id_plat').value = id;
                document.getElementById('nom_plat').value = name;
                document.getElementById('editForm').style.display = 'block';
            }

            function openDeleteForm(id) {
                document.getElementById('deleteClubId').value = id;
                document.getElementById('deleteForm').style.display = 'block';
            }

            function openAddForm() {
                const addForm = document.getElementById('addForm');
                addForm.style.display = (addForm.style.display === 'block') ? 'none' : 'block';
            }
        </script>

        <?php
    }

    private function getIngredientByIdPlat($id_plat) {
        return $this->platDao->getIngredientByIdPlat($id_plat) ?? [];
    }

    private function addPlat($nom_plat, ?string $lien_imageP) {
        if ($this->platDao->addPlat($nom_plat, $lien_imageP)) {
            echo '<p class="success-message">Le plat a été ajouté avec succès !</p>';
            $this->plats = $this->platDao->getLastPlats(10);
        }
    }

    private function deletePlat($id_plat) {
        if ($this->platDao->deletePlatById($id_plat)) {
            echo '<p class="success-message">Le plat a été supprimé avec succès !</p>';
            $this->plats = $this->platDao->getLastPlats(10);
        }
    }

    private function editPlat($id_plat, $nom_plat, ?string $lien_imageP) {
        if ($this->platDao->editPlat($id_plat, $nom_plat, $lien_imageP)) {
            echo '<p class="success-message">Le plat a été modifié avec succès !</p>';
            $this->plats = $this->platDao->getLastPlats(10);
        }
    }

    public function getPlatsParIngredients(array $ingredients = []): array {
        return $this->platDao->getPlatsParIngredients($ingredients) ?? [];
    }
}
?>
