<?php
require_once 'modules/blog/models/Repas/Repas.php';
class RepasDao
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getLastRepas(int $limit): array
    {
        $query = "SELECT id_repas, nom FROM Repas ORDER BY id_repas DESC LIMIT :limit";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $repas = [];
        foreach ($results as $result) {
            $repas[] = new Repas($result['id_repas'], $result['nom']);
        }

        return $repas;
    }


    public function getRepasById(int $id): ?Repas
    {
        $query = "SELECT id, nom FROM Repas WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            return new Repas($result['id_repas'], $result['nom']);
        }

        return null;
    }

    public function addRepas(string $nom): bool
{
    try {
        // Vérification de la longueur du nom de repas, ici 50 caractères
        if (strlen($nom) > 50) {
            throw new InvalidArgumentException('Le nom du repas est trop long (50 caractères max).');
        }

        // Insertion sans spécifier l'id_repas car il est auto-incrémenté
        $query = "INSERT INTO Repas (nom) VALUES (:nom)";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);

        // Exécuter l'insertion
        if (!$stmt->execute()) {
            error_log(print_r($stmt->errorInfo(), true));  // Log des erreurs
            return false;
        }

        return true;
    } catch (PDOException $e) {
        error_log('Erreur lors de l\'insertion : ' . $e->getMessage());
        return false;
    } catch (InvalidArgumentException $e) {
        error_log($e->getMessage());
        return false;
    }
}
}
?>
