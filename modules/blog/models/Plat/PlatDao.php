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
        $query = "SELECT id_plat, nom FROM Plat WHERE id_plat = :id_plat";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id_plat', $id_plat, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            return new Plat($result['id_plat'], $result['nom']);
        }

        return null;
    }

    // Récupérer un plat par nom
    public function getPlatByNom(string $nom): ?Plat
    {
        $query = "SELECT id_plat, nom FROM Plat WHERE nom = :nom";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            return new Plat($result['id_plat'], $result['nom']);
        }

        return null;
    }

    public function getLastPlats(int $limit): array
    {
        $query = "SELECT id_plat, nom FROM Plat ORDER BY id_plat DESC LIMIT :limit";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $plats = [];
        foreach ($results as $result) {
            $plats[] = new Plat($result['id_plat'], $result['nom']);
        }

        return $plats;
    }
    public function addPlat(string $nom): bool
{
    try {
        // Insertion sans spécifier l'id_plat car il est auto-incrémenté
        $query = "INSERT INTO Plat (nom) VALUES (:nom)";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);

        // Exécuter l'insertion
        if (!$stmt->execute()) {
            print_r($stmt->errorInfo());  // Affiche les détails de l'erreur
            return false;
        }

        return true;
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
    
public function updatePlatById(int $id_plat, string $nom): bool
{
    $query = "UPDATE Plat SET nom = :nom WHERE id_plat = :id_plat";
    $stmt = $this->pdo->prepare($query);
    $stmt->bindParam(':id_plat', $id_plat, PDO::PARAM_INT);
    $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);

    return $stmt->execute();
}
    
}
