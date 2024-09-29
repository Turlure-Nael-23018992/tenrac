<?php

require_once 'modules/blog/models/Club/Club.php';

class ClubDao
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

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

    public function addClub(string $nom): bool
    {
        $stmt = $this->db->prepare("INSERT INTO club (nom, id_ordre) VALUES (:nom, 1)");
        $stmt->bindValue(':nom', $nom, PDO::PARAM_STR);

        return $stmt->execute();
    }

    public function deleteClubById(int $id_club): bool
    {
        $stmt = $this->db->prepare("DELETE FROM club WHERE id_club = :id_club");
        $stmt->bindValue(':id_club', $id_club, PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function editClub(int $id_club, string $nom): bool
    {
        $stmt = $this->db->prepare("UPDATE club SET nom = :nom WHERE id_club = :id_club AND id_ordre = 1");
        $stmt->bindValue(':nom', $nom, PDO::PARAM_STR);
        $stmt->bindValue(':id_club', $id_club, PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function getLastClubs(int $limit): array
    {
        $stmt = $this->db->prepare("SELECT id_club, nom, id_ordre FROM club WHERE id_ordre = 1 ORDER BY id_club DESC LIMIT :limit");
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
