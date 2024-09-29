<?php

require_once 'modules/blog/models/Plat/Plat.php';

class PlatDao
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    // Récupérer un plat par ID
    public function getPlatById(int $id_plat): ?Plat
    {
        $query = "SELECT id_plat, nom, lien_imageP FROM Plat WHERE id_plat = :id_plat";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id_plat', $id_plat, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            return new Plat($result['id_plat'], $result['nom'], $result['lien_imageP']);
        }

        return null;
    }

    // Récupérer un plat par nom
    public function getPlatByNom(string $nom): ?Plat
    {
        $query = "SELECT id_plat, nom, lien_imageP FROM Plat WHERE nom = :nom";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            return new Plat($result['id_plat'], $result['nom'], $result['lien_imageP']);
        }

        return null;
    }

    public function getLastPlats(int $limit): array
    {
        $query = "SELECT id_plat, nom, lien_imageP FROM Plat ORDER BY id_plat DESC LIMIT :limit";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $plats = [];
        foreach ($results as $result) {
            $plats[] = new Plat($result['id_plat'], $result['nom'], $result['lien_imageP']);
        }

        return $plats;
    }

    public function addPlat(string $nom, ?string $lien_imageP): bool
    {
        try {
            $query = "INSERT INTO Plat (nom, lien_imageP) VALUES (:nom, :lien_imageP)";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
            $stmt->bindParam(':lien_imageP', $lien_imageP, PDO::PARAM_STR);

            return $stmt->execute();
        } catch (PDOException $e) {
            echo 'Erreur lors de l\'insertion : ' . $e->getMessage();
            return false;
        }
    }

    public function deletePlatById(int $id_plat): bool
    {
        $query = "DELETE FROM Plat WHERE id_plat = :id_plat";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id_plat', $id_plat, PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function editPlat(int $id_plat, string $nom_plat, ?string $lien_imageP): bool
    {
        // Préparez la requête SQL pour mettre à jour le plat
        $sql = "UPDATE Plat SET nom = :nom, lien_imageP = :lien_imageP WHERE id_plat = :id_plat";
        $stmt = $this->pdo->prepare($sql);
        
        // Liez les paramètres
        $stmt->bindParam(':nom', $nom_plat, PDO::PARAM_STR);
        $stmt->bindParam(':lien_imageP', $lien_imageP, PDO::PARAM_STR);
        $stmt->bindParam(':id_plat', $id_plat, PDO::PARAM_INT);
        
        // Exécutez la requête
        return $stmt->execute();
    }

    public function getAllPlats(): array
    {
        $query = "SELECT id_plat, nom, lien_imageP FROM Plat";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $plats = [];
        foreach ($results as $result) {
            $plats[] = new Plat($result['id_plat'], $result['nom'], $result['lien_imageP']);
        }

        return $plats;
    }
    public function getPdo() {
        return $this->pdo;
    }

}
?>
