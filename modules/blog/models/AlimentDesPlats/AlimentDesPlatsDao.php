<?php
require_once 'modules/blog/models/AlimentDesPlats/AlimentDesPlats.php';

class AlimentDesPlatsDAO
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }


    // Récupérer tous les aliments d'un plat
    public function getAlimentsByPlatId(int $id_plat): array
    {
        $query = "SELECT id_aliment FROM aliment_des_plats WHERE id_plat = :id_plat";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id_plat', $id_plat, PDO::PARAM_INT);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $aliments = [];
        foreach ($results as $row) {
            $aliments[] = $row['id_aliment'];
        }

        return $aliments; // Retourne un tableau contenant les id des aliments
    }

    // Récupérer un aliment pour un plat par id_plat et id_aliment
    public function getAlimentDesPlats(int $id_plat, int $id_aliment): ?AlimentDesPlats
    {
        $query = "SELECT id_plat, id_aliment FROM aliment_des_plats WHERE id_plat = :id_plat AND id_aliment = :id_aliment";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id_plat', $id_plat, PDO::PARAM_INT);
        $stmt->bindParam(':id_aliment', $id_aliment, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            return new AlimentDesPlats($result['id_plat'], $result['id_aliment']);
        }

        return null;
    }

    // Ajouter une nouvelle relation aliment-plat
    public function addAlimentDesPlats(int $id_plat, int $id_aliment): bool
    {
        $query = "INSERT INTO aliment_des_plats (id_plat, id_aliment) VALUES (:id_plat, :id_aliment)";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id_plat', $id_plat, PDO::PARAM_INT);
        $stmt->bindParam(':id_aliment', $id_aliment, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
