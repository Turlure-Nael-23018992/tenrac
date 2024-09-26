<?php
require_once 'modules/blog/models/IngAl/IngAl.php';

class IngAlDAO
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    // Récupérer la relation ingrédient-aliment
    public function getIngAl(int $id_ingredient, int $id_aliment): ?IngAl
    {
        $query = "SELECT id_ingredient, id_aliment FROM ing_al WHERE id_ingredient = :id_ingredient AND id_aliment = :id_aliment";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id_ingredient', $id_ingredient, PDO::PARAM_INT);
        $stmt->bindParam(':id_aliment', $id_aliment, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            return new IngAl($result['id_ingredient'], $result['id_aliment']);
        }

        return null;
    }

    // Ajouter une relation ingrédient-aliment
    public function addIngAl(int $id_ingredient, int $id_aliment): bool
    {
        $query = "INSERT INTO ing_al (id_ingredient, id_aliment) VALUES (:id_ingredient, :id_aliment)";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id_ingredient', $id_ingredient, PDO::PARAM_INT);
        $stmt->bindParam(':id_aliment', $id_aliment, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Récupérer tous les aliments pour un ingrédient spécifique
    public function getAlimentsByIngredient(int $id_ingredient): array
    {
        $query = "SELECT id_aliment FROM ing_al WHERE id_ingredient = :id_ingredient";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id_ingredient', $id_ingredient, PDO::PARAM_INT);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $aliments = [];
        foreach ($results as $row) {
            $aliments[] = $row['id_aliment'];
        }

        return $aliments; // Retourne un tableau d'IDs des aliments
    }
}
