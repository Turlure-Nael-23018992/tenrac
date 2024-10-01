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
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            
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
                            <button class="edit-btn" onclick="openEditForm(<?= htmlspecialchars($plat->getIdPlat()) ?>, '<?= htmlspecialchars($plat->getNom()) ?>')"><ion-icon name="create-outline">Modifier</ion-icon></button>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </main>
        <?php include_once "footer.php" ?>
        <form method="POST" action="" style="display:none;" class="edit-form" id="editForm">
            <input type="hidden" name="action" value="edit">
            <input type="hidden" id="id_plat" name="id_plat" value="<?= htmlspecialchars($plat->getIdPlat()) ?>">
            <input type="text" id="nom_plat" name="nom_plat" value="<?= htmlspecialchars($plat->getNom()) ?>" required>
            <input type="text" name="lien_imageP" value="<?= htmlspecialchars($plat->getLienImageP()) ?>">
            <button type="submit">Modifier</button>
        </form>

        <script>
            function openEditForm(id, name) {
                console.log(id + " "+ name);
                document.getElementById('id_plat').value = id;
                document.getElementById('nom_plat').value = name;
                document.getElementById('editForm').style.display = 'block';
            }
        </script>
        <?php
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
    public function getPlatsParIngredient(array $ingredients = []): array {
        if ($this->platDao->getPlatsParIngredients($ingredients)) {
            return $this->platDao->getPlatsParIngredients($ingredients);
        } else {
            echo '<p class="error-message">Erreur lors de la recherche des plats.</p>';
        }
        
    }
    
    
}
?>