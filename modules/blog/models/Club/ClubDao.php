<?php

require_once 'modules/blog/models/Club/Club.php';

/**
 * Classe ClubDao
 *
 * Cette classe gère les opérations CRUD (Create, Read, Update, Delete) pour les clubs dans la base de données.
 */
class ClubDao
{
    /**
     * @var PDO $db Instance de PDO pour interagir avec la base de données.
     */
    private PDO $db;

    /**
     * Constructeur de la classe ClubDao.
     *
     * @param PDO $db Instance de PDO pour la connexion à la base de données.
     */
    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    /**
     * Récupérer tous les clubs avec un id_ordre égal à 1.
     *
     * @return Club[] Retourne un tableau d'instances de la classe Club.
     */
    public function getAllClubs(): array
    {
        $stmt = $this->db->prepare("SELECT id_club, nom, id_ordre FROM club WHERE id_ordre = 1");
        $stmt->execute();

        $clubs = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $clubs[] = new Club($row['id_club'], $row['nom'], $row['id_ordre']);
        }

        return $clubs;
    }

    /**
     * Ajouter un nouveau club avec id_ordre par défaut à 1.
     *
     * @param string $nom Le nom du club à ajouter.
     * @return bool Retourne true si l'ajout a réussi, sinon false.
     */
    public function addClub(string $nom): bool
    {
        $stmt = $this->db->prepare("INSERT INTO club (nom, id_ordre) VALUES (:nom, 1)");
        $stmt->bindValue(':nom', $nom, PDO::PARAM_STR);

        return $stmt->execute();
    }

    /**
     * Supprimer un club en fonction de son ID. Si on supprime un club alors tout les membres de ce club n'y sont plus affectés.
     *
     * @param int $id_club L'ID du club à supprimer.
     * @return bool Retourne true si la suppression a réussi, sinon false.
     */
    public function deleteClubById(int $id_club): bool
    {
        $supp = $this->db->prepare("UPDATE Tenrac SET id_club = NULL WHERE id_club = :id_club");
        $supp->bindValue(':id_club', $id_club, PDO::PARAM_INT);

        if ($supp->execute()) {
            $stmt = $this->db->prepare("DELETE FROM club WHERE id_club = :id_club");
            $stmt->bindValue(':id_club', $id_club, PDO::PARAM_INT);
            return $stmt->execute();
        }
    
        return false;
    }
    

    /**
     * Modifier le nom d'un club en fonction de son ID.
     *
     * @param int $id_club L'ID du club à modifier.
     * @param string $nom Le nouveau nom du club.
     * @return bool Retourne true si la mise à jour a réussi, sinon false.
     */
    public function editClub(int $id_club, string $nom): bool
    {
        $stmt = $this->db->prepare("UPDATE club SET nom = :nom WHERE id_club = :id_club AND id_ordre = 1");
        $stmt->bindValue(':nom', $nom, PDO::PARAM_STR);
        $stmt->bindValue(':id_club', $id_club, PDO::PARAM_INT);

        return $stmt->execute();
    }

    /**
     * Récupérer les derniers clubs ajoutés, limités par un nombre spécifié.
     *
     * @param int $limit Le nombre maximum de clubs à récupérer.
     * @return Club[] Retourne un tableau d'instances de la classe Club.
     */
    public function getLastClubs(int $limit): array
    {
        $stmt = $this->db->prepare(<<<SQL
            SELECT id_club, nom, id_ordre 
            FROM club 
            WHERE id_ordre = 1 
            ORDER BY id_club DESC 
            LIMIT :limit
        SQL);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();

        $clubs = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $clubs[] = new Club($row['id_club'], $row['nom'], $row['id_ordre']);
        }

        return $clubs;
    }
}
?>