<?php

class PlatPage {
    private $plats;
    private $platDao; // Ajout de la propriété DAO

    // Modifier le constructeur pour accepter une instance de DAO
    public function __construct($plats, $platDao) {
        $this->plats = $plats;
        $this->platDao = $platDao; // Initialisation de l'objet DAO
    }

    public function show(): void {
        // Gestion des requêtes POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Traitement de la recherche de plats
            if (isset($_POST['search'])) {
                $searchTerm = $_POST['search'];
                // Appel de la fonction de recherche avec le terme saisi
                $platsTrouves = $this->getPlatsParIngredients([$searchTerm]);
                // Affichage des résultats
                $this->afficherResultatsRecherche($platsTrouves, $searchTerm);
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
        include 'header.php'
        ?>
        
        <main>
            <a href='/?page=dashboard' class="button">Retour au dashboard</a>
            <a href='?page=dashboardClub' class="button">Gérer les clubs</a>
            <a href='?page=dashboardTenrac' class="button">Gérer les Tenracs</a>
            <div class="plats">
                <h1>Nos Plats</h1>
                <table>
                    <thead>
                        <tr>
                            <th>ID Plat</th>
                            <th>Nom</th>
                            <th>Lien Image</th>
                            <th>Ordre</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($this->plats as $plat): ?>
                            <tr>
                                <td><?= htmlspecialchars($plat->getIdPlat()) ?></td>
                                <td><?= htmlspecialchars($plat->getNom()) ?></td>
                                <td><?= htmlspecialchars($plat->getLienImageP() ?? 'Aucun') ?></td>
                                <td>Ordre des Tenrac</td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?php if (isset($_SESSION['email'])) { ?>
                <div class="add-plat">
                    <h2>Ajouter un plat</h2>
                    <form method="POST" action="">
                        <input type="hidden" name="action" value="add">
                        <label for="nom_plat">Nom du plat :</label>
                        <input type="text" id="nom_plat" name="nom_plat" required>

                        <label for="lien_imageP">Lien de l'image :</label>
                        <input type="text" id="lien_imageP" name="lien_imageP">

                        <button type="submit">Ajouter</button>
                    </form>
                </div>

                <div class="delete-plat">
                    <h2>Supprimer un plat</h2>
                    <form method="POST" action="">
                        <input type="hidden" name="action" value="delete">
                        <label for="id_plat">ID du plat à supprimer :</label>
                        <select id="id_plat" name="id_plat" required>
                            <option value="">Sélectionner un plat</option>
                            <?php foreach ($this->plats as $plat): ?>
                                <option value="<?= htmlspecialchars($plat->getIdPlat()) ?>"><?= htmlspecialchars($plat->getNom()) ?></option>
                            <?php endforeach; ?>
                        </select>

                        <button type="submit">Supprimer</button>
                    </form>
                </div>

                <div class="edit-plat">
                    <h2>Modifier un plat</h2>
                    <form method="POST" action="">
                        <input type="hidden" name="action" value="edit">
                        <label for="id_plat">ID du plat à modifier :</label>
                        <select id="id_plat" name="id_plat" required onchange="loadPlatData(this.value)">
                            <option value="">Sélectionner un plat</option>
                            <?php foreach ($this->plats as $plat): ?>
                                <option value="<?= htmlspecialchars($plat->getIdPlat()) ?>"><?= htmlspecialchars($plat->getNom()) ?></option>
                            <?php endforeach; ?>
                        </select>

                        <label for="nom_plat">Nom du plat :</label>
                        <input type="text" id="nom_plat" name="nom_plat" required>

                        <label for="lien_imageP">Lien de l'image :</label>
                        <input type="text" id="lien_imageP" name="lien_imageP">

                        <button type="submit">Modifier</button>
                    </form>
                </div>
                <?php } ?>
                <div>
                <form action="" method="post">
                        <input type="search" name="search" placeholder="Rechercher un plat">
                        <button type="submit">Rechercher</button>
                    </form>
                    <div id="plat-rechercher">

                    </div>
                </div>
            </div>
        </main>
        <script>
            function loadPlatData(id) {
                const plats = <?= json_encode($this->plats) ?>;
                const plat = plats.find(plat => plat.id === id);
                if (plat) {
                    document.getElementById('nom_plat').value = plat.nom;
                    document.getElementById('lien_imageP').value = plat.lien_imageP;
                } else {
                    document.getElementById('nom_plat').value = '';
                    document.getElementById('lien_imageP').value = '';
                }
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
    public function getPlatsParIngredients(array $ingredients = []): array {
        $pdo = $this->platDao->getPdo(); // Récupération de l'objet PDO depuis le DAO
    
        $query = "SELECT DISTINCT p.id_plat, p.nom, p.lien_imageP 
                  FROM Plat p 
                  JOIN Plat_Ingredient pi ON p.id_plat = pi.id_plat
                  JOIN Ingredient i ON pi.id_ingredient = i.id_ingredient";
    
        if (!empty($ingredients)) {
            $placeholders = array_fill(0, count($ingredients), '?');
            $query .= " WHERE i.nom IN (" . implode(',', $placeholders) . ")";
        }
    
        // Préparer la requête avec l'objet PDO
        $stmt = $pdo->prepare($query);
        $stmt->execute($ingredients);
    
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        $plats = [];
        foreach ($results as $result) {
            $plats[] = new Plat($result['id_plat'], $result['nom'], $result['lien_imageP']);
        }
    
        return $plats;
    }
    
    // Méthode d'affichage des résultats de recherche
    private function afficherResultatsRecherche(array $platsTrouves, string $searchTerm): void {
        if (!empty($platsTrouves)) {
            echo '<h2>Résultats de la recherche pour "' . htmlspecialchars($searchTerm) . '"</h2>';
            foreach ($platsTrouves as $plat) {
                echo '<div class="plat">';
                echo '<h3>' . htmlspecialchars($plat->getNom()) . '</h3>';
                echo '<img src="' . htmlspecialchars($plat->getLienImageP()) . '" alt="Image du plat">';
                echo '</div>';
            }
        } else {
            echo '<p>Aucun plat trouvé pour "' . htmlspecialchars($searchTerm) . '"</p>';
        }
    }
}
?>
