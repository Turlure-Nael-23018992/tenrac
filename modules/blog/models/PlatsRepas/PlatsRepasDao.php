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
        $query = "INSERT INTO Plats_repas (id_plat, id_repas) VALUES (:id_plat, :id_repas)";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id_plat', $id_plat, PDO::PARAM_INT);
        $stmt->bindParam(':id_repas', $id_repas, PDO::PARAM_INT);

        return $stmt->execute();
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
