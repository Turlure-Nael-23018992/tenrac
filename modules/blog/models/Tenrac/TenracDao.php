<?php

require_once 'modules/blog/models/Tenrac/Tenrac.php';

class TenracDao
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }
    public function getLastTenracs(int $limit): array
    {
        $query = "SELECT * FROM Tenrac ORDER BY id_tenrac DESC LIMIT :limit";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $tenracs = [];
        foreach ($results as $result) {
            $tenracs[] = new Tenrac(
                $result['id_tenrac'],
                $result['nom'],
                $result['couriel'],
                $result['tel'],
                $result['adresse'],
                $result['grade'],
                $result['id_club'],
                $result['id_ordre'],
                $result['rang'] ?? null,
                $result['titre'] ?? null,
                $result['dignite'] ?? null
            );
        }

        return $tenracs;
    }
    // Récupérer un tenrac par ID
    public function getTenracById(int $id_tenrac): ?Tenrac
    {
        $query = "SELECT * FROM Tenrac WHERE id_tenrac = :id_tenrac";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id_tenrac', $id_tenrac, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            return new Tenrac(
                $result['id_tenrac'],
                $result['nom'],
                $result['couriel'],
                $result['tel'],
                $result['adresse'],
                $result['grade'],
                $result['id_club'],
                $result['id_ordre'],
                $result['rang'] ?? null,
                $result['titre'] ?? null,
                $result['dignite'] ?? null
            );
        }

        return null;
    }

    // Récupérer un tenrac par nom
    public function getTenracByNom(string $nom): ?Tenrac
    {
        $query = "SELECT * FROM Tenrac WHERE nom = :nom";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            return new Tenrac(
                $result['id_tenrac'],
                $result['nom'],
                $result['couriel'],
                $result['tel'],
                $result['adresse'],
                $result['grade'],
                $result['id_club'],
                $result['id_ordre'],
                $result['rang'] ?? null,
                $result['titre'] ?? null,
                $result['dignite'] ?? null
            );
        }

        return null;
    }

    // Récupérer tous les tenracs
    public function getAllTenracs(): array
    {
        $query = "SELECT * FROM Tenrac";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $tenracs = [];
        foreach ($results as $result) {
            $tenracs[] = new Tenrac(
                $result['id_tenrac'],
                $result['nom'],
                $result['couriel'],
                $result['tel'],
                $result['adresse'],
                $result['grade'],
                $result['id_club'],
                $result['id_ordre'],
                $result['rang'] ?? null,
                $result['titre'] ?? null,
                $result['dignite'] ?? null
            );
        }

        return $tenracs;
    }

    // Ajouter un tenrac
    public function addTenrac(
        string $nom,
        string $couriel,
        string $tel,
        string $adresse,
        string $grade,
        int $id_club,
        int $id_ordre,
        ?string $rang = null,
        ?string $titre = null,
        ?string $dignite = null
    ): bool {
        try {
            $query = "INSERT INTO Tenrac (nom, couriel, tel, adresse, grade, id_club, id_ordre, rang, titre, dignite) 
                      VALUES (:nom, :couriel, :tel, :adresse, :grade, :id_club, :id_ordre, :rang, :titre, :dignite)";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
            $stmt->bindParam(':couriel', $couriel, PDO::PARAM_STR);
            $stmt->bindParam(':tel', $tel, PDO::PARAM_STR);
            $stmt->bindParam(':adresse', $adresse, PDO::PARAM_STR);
            $stmt->bindParam(':grade', $grade, PDO::PARAM_STR);
            $stmt->bindParam(':id_club', $id_club, PDO::PARAM_INT);
            $stmt->bindParam(':id_ordre', $id_ordre, PDO::PARAM_INT);
            $stmt->bindParam(':rang', $rang, PDO::PARAM_STR);
            $stmt->bindParam(':titre', $titre, PDO::PARAM_STR);
            $stmt->bindParam(':dignite', $dignite, PDO::PARAM_STR);

            return $stmt->execute();
        } catch (PDOException $e) {
            echo 'Erreur lors de l\'insertion : ' . $e->getMessage();
            return false;
        }
    }

    // Éditer un tenrac
    public function editTenrac(
        int $id_tenrac,
        string $nom,
        string $couriel,
        string $tel,
        string $adresse,
        string $grade,
        int $id_club,
        ?string $rang = null,
        ?string $titre = null,
        ?string $dignite = null
    ): bool {
        $query = "UPDATE Tenrac 
                  SET nom = :nom, couriel = :couriel, tel = :tel, adresse = :adresse, 
                      grade = :grade, id_club = :id_club, rang = :rang, titre = :titre, dignite = :dignite 
                  WHERE id_tenrac = :id_tenrac";
        $stmt = $this->pdo->prepare($query);
        
        $stmt->bindParam(':id_tenrac', $id_tenrac, PDO::PARAM_INT);
        $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
        $stmt->bindParam(':couriel', $couriel, PDO::PARAM_STR);
        $stmt->bindParam(':tel', $tel, PDO::PARAM_STR);
        $stmt->bindParam(':adresse', $adresse, PDO::PARAM_STR);
        $stmt->bindParam(':grade', $grade, PDO::PARAM_STR);
        $stmt->bindParam(':id_club', $id_club, PDO::PARAM_INT);
        $stmt->bindParam(':rang', $rang, PDO::PARAM_STR);
        $stmt->bindParam(':titre', $titre, PDO::PARAM_STR);
        $stmt->bindParam(':dignite', $dignite, PDO::PARAM_STR);

        return $stmt->execute();
    }

    // Supprimer un tenrac par ID
    public function deleteTenracById(int $id_tenrac): bool
    {
        $query = "DELETE FROM Tenrac WHERE id_tenrac = :id_tenrac";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id_tenrac', $id_tenrac, PDO::PARAM_INT);

        return $stmt->execute();
    }
}
?>