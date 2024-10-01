<?php

class TenracPage {
    private array $tenracs;

    public function __construct(array $tenracs) {
        $this->tenracs = $tenracs;
    }

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
        ?>
        <head>
            <link rel="stylesheet" href="_assets/styles/tenrac.css">
        </head>
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
            <?php if (isset($_SESSION['email'])) { ?>
            <div id="editModal" class="modal">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <h2>Modifier un Tenrac</h2>
                    <form id="editTenracForm" method="POST" action="">
                        <input type="hidden" name="action" value="edit">
                        <input type="hidden" id="edit_id_tenrac" name="id_tenrac" value="">

                        <label for="edit_nom">Nom du Tenrac :</label>
                        <input type="text" id="edit_nom" name="nom" required>

                        <label for="edit_couriel">Courriel :</label>
                        <input type="email" id="edit_couriel" name="couriel" required>

                        <label for="edit_tel">Téléphone :</label>
                        <input type="text" id="edit_tel" name="tel" required>

                        <label for="edit_adresse">Adresse :</label>
                        <input type="text" id="edit_adresse" name="adresse" required>

                        <label for="edit_grade">Grade :</label>
                        <input type="text" id="edit_grade" name="grade" required>

                        <label for="edit_id_club">ID Club :</label>
                        <input type="number" id="edit_id_club" name="id_club" required>

                        <label for="edit_id_ordre">ID Ordre :</label>
                        <input type="number" id="edit_id_ordre" name="id_ordre" required>

                        <button type="submit">Enregistrer les modifications</button>
                    </form>
                </div>
            </div>
            <?php } ?>
            <?php } ?>
        </main>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var modal = document.getElementById('editModal');
                var span = document.getElementsByClassName('close')[0];

                document.querySelectorAll('.edit-btn').forEach(function(button) {
                    button.addEventListener('click', function(e) {
                        e.preventDefault();

                        var card = this.closest('.card');
                        var idTenrac = card.querySelector('input[name="id_tenrac"]').value;
                        var nom = card.querySelector('h2').innerText;
                        var couriel = card.querySelector('p:nth-of-type(1)').innerText.replace("Email :", "").trim();
                        var tel = card.querySelector('p:nth-of-type(2)').innerText.replace("Téléphone :", "").trim();
                        var adresse = card.querySelector('p:nth-of-type(3)').innerText.replace("Adresse :", "").trim();
                        var grade = card.querySelector('p:nth-of-type(4)').innerText.replace("Grade :", "").trim();

                        document.getElementById('edit_id_tenrac').value = idTenrac;
                        document.getElementById('edit_nom').value = nom;
                        document.getElementById('edit_couriel').value = couriel;
                        document.getElementById('edit_tel').value = tel;
                        document.getElementById('edit_adresse').value = adresse;
                        document.getElementById('edit_grade').value = grade;

                        modal.style.display = "block";
                    });
                });

                span.onclick = function() {
                    modal.style.display = "none";
                }

                window.onclick = function(event) {
                    if (event.target == modal) {
                        modal.style.display = "none";
                    }
                }
            });
        </script>

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
