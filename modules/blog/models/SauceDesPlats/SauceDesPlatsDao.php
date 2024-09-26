<?php
require_once 'modules/blog/models/SauceDesPlats/SauceDesPlats.php';

class SauceDesPlatDAO
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    // Récupérer toutes les sauces pour un plat donné
    public function getSaucesByPlatId(int $id_plat): array
    {
        $query = "SELECT id_sauce FROM sauce_des_plat WHERE id_plat = :id_plat";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id_plat', $id_plat, PDO::PARAM_INT);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $sauceList = [];
        foreach ($results as $row) {
            $sauceList[] = $row['id_sauce'];
        }

        return $sauceList;
    }

    // Ajouter une nouvelle association plat-sauce
    public function addSauceToPlat(int $id_plat, int $id_sauce): bool
    {
        $query = "INSERT INTO sauce_des_plat (id_plat, id_sauce) VALUES (:id_plat, :id_sauce)";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id_plat', $id_plat, PDO::PARAM_INT);
        $stmt->bindParam(':id_sauce', $id_sauce, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
