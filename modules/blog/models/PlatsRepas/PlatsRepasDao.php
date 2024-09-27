<?php
require_once 'modules/blog/models/PlatsRepas/PlatsRepas.php';

class PlatsRepasDAO
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    // Ajouter un nouveau plat à un repas
    public function addPlatRepas(int $id_plat, int $id_repas): bool
    {
        try {
            // Vérification des ID (id_plat et id_repas doivent être positifs)
            if ($id_plat <= 0 || $id_repas <= 0) {
                throw new InvalidArgumentException('Les id des plats/repas doivent être positifs.');
            }

            // Préparer la requête d'insertion
            $query = "INSERT INTO Plats_repas (id_plat, id_repas) VALUES (:id_plat, :id_repas)";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':id_plat', $id_plat, PDO::PARAM_INT);
            $stmt->bindParam(':id_repas', $id_repas, PDO::PARAM_INT);

            // Exécuter la requête et vérifier son succès
            if (!$stmt->execute()) {
                error_log(print_r($stmt->errorInfo(), true));
                return false;
            }

            return true;
        } catch (PDOException $e) {
            error_log('Erreur lors de l\'insertion dans Plats_repas : ' . $e->getMessage());
            return false;
        } catch (InvalidArgumentException $e) {
            error_log($e->getMessage());
            return false;
        }
    }


    // Récupérer tous les plats associés à un repas
    public function getPlatsByRepasId(int $id_repas): array
    {
        $query = "SELECT id_plat, id_repas FROM Plats_repas WHERE id_repas = :id_repas";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id_repas', $id_repas, PDO::PARAM_INT);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $platsList = [];
        foreach ($results as $row) {
            $platsList[] = new PlatsRepas($row['id_plat'], $row['id_repas']);
        }

        return $platsList;
    }

    // Récupérer tous les repas contenant un certain plat
    public function getRepasByPlatId(int $id_plat): array
    {
        $query = "SELECT id_plat, id_repas FROM Plats_repas WHERE id_plat = :id_plat";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id_plat', $id_plat, PDO::PARAM_INT);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $repasList = [];
        foreach ($results as $row) {
            $repasList[] = new PlatsRepas($row['id_plat'], $row['id_repas']);
        }

        return $repasList;
    }
}
