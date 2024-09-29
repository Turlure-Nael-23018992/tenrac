<?php
class DashboardPlat {
    private $plats;

    public function __construct($plats) {
        $this->plats = $plats;
    }

    public function show(): void {
        // Traitement du formulaire d'ajout de plat
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Vérification si c'est le formulaire d'ajout
            if (isset($_POST['action']) && $_POST['action'] === 'add') {
                $nom_plat = isset($_POST['nom_plat']) ? trim($_POST['nom_plat']) : '';
                $lien_imageP = isset($_POST['lien_imageP']) ? trim($_POST['lien_imageP']) : null;

                // Vérification des champs
                if (empty($nom_plat)) {
                    echo '<p class="error-message">Veuillez remplir tous les champs.</p>';
                } else {
                    $this->addPlat($nom_plat, $lien_imageP);
                }
            }
            
            // Vérification si c'est le formulaire de suppression
            if (isset($_POST['action']) && $_POST['action'] === 'delete') {
                $id_plat = isset($_POST['id_plat']) ? trim($_POST['id_plat']) : null;

                if ($id_plat) {
                    $this->deletePlat($id_plat);
                } else {
                    echo '<p class="error-message">Veuillez sélectionner un plat à supprimer.</p>';
                }
            }

            // Vérification si c'est le formulaire de modification
            if (isset($_POST['action']) && $_POST['action'] === 'edit') {
                $id_plat = isset($_POST['id_plat']) ? trim($_POST['id_plat']) : null;
                $nom_plat = isset($_POST['nom_plat']) ? trim($_POST['nom_plat']) : '';
                $lien_imageP = isset($_POST['lien_imageP']) ? trim($_POST['lien_imageP']) : null;

                if ($id_plat && !empty($nom_plat)) {
                    $this->editPlat($id_plat, $nom_plat, $lien_imageP);
                } else {
                    echo '<p class="error-message">Veuillez remplir tous les champs.</p>';
                }
            }
        }

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

    private function addPlat($nom_plat, ?string $lien_imageP) {
        $platDao = new PlatDao(Database::getInstance());

        if ($platDao->addPlat($nom_plat, $lien_imageP)) {
            echo '<p class="success-message">Le plat a été ajouté avec succès !</p>';
            $this->plats = $platDao->getLastPlats(10);
        } else {
            echo '<p class="error-message">Erreur lors de l\'ajout du plat.</p>';
        }
    }

    private function deletePlat($id_plat) {
        $platDao = new PlatDao(Database::getInstance());

        if ($platDao->deletePlatById($id_plat)) {
            echo '<p class="success-message">Le plat a été supprimé avec succès !</p>';
            $this->plats = $platDao->getLastPlats(10);
        } else {
            echo '<p class="error-message">Erreur lors de la suppression du plat.</p>';
        }
    }

    private function editPlat($id_plat, $nom_plat, ?string $lien_imageP) {
        $platDao = new PlatDao(Database::getInstance());

        if ($platDao->editPlat($id_plat, $nom_plat, $lien_imageP)) {
            echo '<p class="success-message">Le plat a été modifié avec succès !</p>';
            $this->plats = $platDao->getLastPlats(10);
        } else {
            echo '<p class="error-message">Erreur lors de la modification du plat.</p>';
        }
    }
}
?>