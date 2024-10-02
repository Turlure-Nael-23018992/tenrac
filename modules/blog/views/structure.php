<?php
/**
 * Classe Structure qui gère l'affichage et la gestion des clubs.
 *
 * Cette classe permet d'afficher les clubs et propose des fonctionnalités
 * pour ajouter, modifier et supprimer un club.
 */
class Structure {
    /**
     * @var array $clubs Tableau contenant la liste des clubs.
     */
    private $clubs;

    /**
     * Constructeur de la classe Structure.
     *
     * @param array $clubs Tableau des clubs à afficher.
     */
    public function __construct($clubs) {
        $this->clubs = $clubs;
    }

    /**
     * Méthode pour afficher les clubs et traiter les formulaires.
     *
     * Cette méthode traite les actions POST pour ajouter, modifier ou supprimer un club,
     * puis affiche la liste des clubs. Elle inclut également des formulaires pour ces actions.
     *
     * @return void
     */
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
        // Affichage HTML des clubs et des formulaires
    }

    /**
     * Ajoute un nouveau club dans la base de données.
     *
     * Cette méthode prend le nom du club et l'ID de l'ordre associé,
     * puis ajoute le club dans la base de données via ClubDao.
     *
     * @param string $nom_club Le nom du club à ajouter.
     * @param int $id_ordre L'ID de l'ordre auquel le club est associé.
     * @return void
     */
    function addClub($nom_club, $id_ordre) {
        $clubDao = new ClubDao(Database::getInstance());

        if ($clubDao->addClub($nom_club, $id_ordre)) {
            echo '<p class="success-message">Le club a été ajouté avec succès !</p>';
            $this->clubs = $clubDao->getLastClubs(10);
        } else {
            echo '<p class="error-message">Erreur lors de l\'ajout du club.</p>';
        }
    }

    /**
     * Supprime un club de la base de données.
     *
     * Cette méthode prend l'ID d'un club et le supprime de la base de données via ClubDao.
     *
     * @param int $id_club L'ID du club à supprimer.
     * @return void
     */
    private function deleteClub($id_club) {
        $clubDao = new ClubDao(Database::getInstance());

        if ($clubDao->deleteClubById($id_club)) {
            echo '<p class="success-message">Le club a été supprimé avec succès !</p>';
            $this->clubs = $clubDao->getLastClubs(10);
        } else {
            echo '<p class="error-message">Erreur lors de la suppression du club.</p>';
        }
    }

    /**
     * Modifie les informations d'un club dans la base de données.
     *
     * Cette méthode prend l'ID du club, le nom modifié, et l'ID de l'ordre associé,
     * puis met à jour le club dans la base de données via ClubDao.
     *
     * @param int $id_club L'ID du club à modifier.
     * @param string $nom_club Le nouveau nom du club.
     * @param int $id_ordre L'ID de l'ordre auquel le club est associé.
     * @return void
     */
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