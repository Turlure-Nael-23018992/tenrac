<?php

class PlatPage {
    private $plats;
    private $platDao;
    // Modifier le constructeur pour accepter une instance de DAO
    public function __construct($plats, $platDao) {
        $this->plats = $plats;// Initialisation de l'objet DAO
        $this->platDao = $platDao;
    }

    public function show(): void {
        // Gestion des requêtes POST
        $platsTrouves = []; // Initialise la variable ici pour la rendre accessible partout dans la méthode
        $searchTerm = ''; // Initialise le terme de recherche
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            // Traitement de la recherche
            if (isset($_POST['search'])) {
                $searchTerm = $_POST['search'];
                // Appel de la fonction de recherche avec le terme saisi
                $platsTrouves = $this->getPlatsParIngredients([$searchTerm]);
                // Affichage des résultats
            }
    
            // Traitement du formulaire d'ajout de plat
            if (isset($_POST['action']) && $_POST['action'] === 'add') {
                $nom_plat = trim($_POST['nom_plat'] ?? '');
                $lien_imageP = trim($_POST['lien_imageP'] ?? null);
                
                if (empty($nom_plat)) {
                    echo '<p class="error-message">Veuillez remplir tous les champs.</p>';
                } else {
                    $this->addPlat($nom_plat, $lien_imageP);
                }
            }
    
            // Traitement du formulaire de suppression
            if (isset($_POST['action']) && $_POST['action'] === 'delete') {
                $id_plat = trim($_POST['id_plat'] ?? null);
    
                if ($id_plat) {
                    $this->deletePlat($id_plat);
                } else {
                    echo '<p class="error-message">Veuillez sélectionner un plat à supprimer.</p>';
                }
            }
    
            // Traitement du formulaire de modification
            if (isset($_POST['action']) && $_POST['action'] === 'edit') {
                $id_plat = trim($_POST['id_plat'] ?? null);
                $nom_plat = trim($_POST['nom_plat'] ?? '');
                $lien_imageP = trim($_POST['lien_imageP'] ?? null);
    
                if ($id_plat && !empty($nom_plat)) {
                    $this->editPlat($id_plat, $nom_plat, $lien_imageP);
                } else {
                    echo '<p class="error-message">Veuillez remplir tous les champs.</p>';
                }
            }
        }
    
        // Affichage du formulaire et de la liste des plats
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
                        <button onclick="openIngredient(<?= htmlspecialchars($plat->getIdPlat()) ?>)">i</button>
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
        </main>
    
        <?php include_once "footer.php"; ?>
        <form method="POST" action="" style="display:none;" class="edit-form" id="editForm">
            <input type="hidden" name="action" value="edit">
            <input type="hidden" id="id_plat" name="id_plat" value="<?= htmlspecialchars($plat->getIdPlat()) ?>">
            <input type="text" id="nom_plat" name="nom_plat" value="<?= htmlspecialchars($plat->getNom()) ?>" required>
            <button type="submit">Modifier</button>
        </form>
    
        <div id="deleteForm" class="delete-form" style="display:none;">
            <form method="POST" action="">
                <input type="hidden" name="action" value="delete">
                <input type="hidden" id="deleteClubId" name="id_plat">
                <p>Êtes-vous sûr de vouloir supprimer ce plat ?</p>
                <button type="submit">Supprimer</button>
            </form>
        </div>
    
        <div id="addForm" class="add-form">
            <form method="POST" action="">
                <input type="hidden" name="action" value="add">
                <label for="addClubName">Nom du plat :</label>
                <input type="text" id="addClubName" name="nom_plat" required>
                <input type="hidden" name="id_ordre" value="1">
                <button type="submit">Ajouter</button>
            </form>
        </div>
        <script>
            function openEditForm(id, name) {
                document.getElementById('id_plat').value = id;
                document.getElementById('nom_plat').value = name;
                document.getElementById('editForm').style.display = 'block';
            }
            function openDeleteForm(id) {
                console.log(id);
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
    private function getIngredientByIdPlat($igredient ) {
        ///bref
    }
    // Méthode pour ajouter un plat
    private function addPlat($nom_plat, ?string $lien_imageP) {
        if ($this->platDao->addPlat($nom_plat, $lien_imageP)) {
            echo '<p class="success-message">Le plat a été ajouté avec succès !</p>';
            $this->plats = $this->platDao->getLastPlats(10);
        } else {
            echo '<p class="error-message">Erreur lors de l\'ajout du plat.</p>';
        }
    }

    // Méthode pour supprimer un plat
    private function deletePlat($id_plat) {
        if ($this->platDao->deletePlatById($id_plat)) {
            echo '<p class="success-message">Le plat a été supprimé avec succès !</p>';
            $this->plats = $this->platDao->getLastPlats(10);
        } else {
            echo '<p class="error-message">Erreur lors de la suppression du plat.</p>';
        }
    }

    // Méthode pour modifier un plat
    private function editPlat($id_plat, $nom_plat, ?string $lien_imageP) {
        if ($this->platDao->editPlat($id_plat, $nom_plat, $lien_imageP)) {
            echo '<p class="success-message">Le plat a été modifié avec succès !</p>';
            $this->plats = $this->platDao->getLastPlats(10);
        } else {
            echo '<p class="error-message">Erreur lors de la modification du plat.</p>';
        }
    }

    // Méthode de recherche de plats par ingrédients
    public function getPlatsParIngredients(array $ingredients = []): array {
        if ($this->platDao->getPlatsParIngredients($ingredients)) {
            return $this->platDao->getPlatsParIngredients($ingredients);
        } else {
            echo '<p class="error-message">Erreur lors de la recherche des plats.</p>';
        }
        
    }

    
    
    
}
?>