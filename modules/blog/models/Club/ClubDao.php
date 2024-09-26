<?php

class ClubDAO
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    // Récupérer un club par ID
    public function getClubById(int $id_club): ?Club
    {
        $query = "SELECT id_club, nom, id_ordre FROM club WHERE id_club = :id_club";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id_club', $id_club, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            return new Club($result['id_club'], $result['nom'], $result['id_ordre']);
        }

        return null;
    }

    // Récupérer un club par nom
    public function getClubByNom(string $nom): ?Club
    {
        $query = "SELECT id_club, nom, id_ordre FROM club WHERE nom = :nom";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            return new Club($result['id_club'], $result['nom'], $result['id_ordre']);
        }

        return null;
    }

    // Ajouter un nouveau club
    public function addClub(string $nom, int $id_ordre): bool
    {
        $query = "INSERT INTO club (nom, id_ordre) VALUES (:nom, :id_ordre)";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
        $stmt->bindParam(':id_ordre', $id_ordre, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Récupérer tous les clubs par id_ordre
    public function getClubsByIdOrdre(int $id_ordre): array
    {
        $query = "SELECT id_club, nom, id_ordre FROM club WHERE id_ordre = :id_ordre";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id_ordre', $id_ordre, PDO::PARAM_INT);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $clubs = [];
        foreach ($results as $row) {
            $clubs[] = new Club($row['id_club'], $row['nom'], $row['id_ordre']);
        }

        return $clubs;
    }
}
