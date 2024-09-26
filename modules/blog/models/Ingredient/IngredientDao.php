<?php

class IngredientDAO
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    // Récupérer un ingrédient par ID
    public function getIngredientById(int $id_ingredient): ?Ingredient
    {
        $query = "SELECT id_ingredient, nom, type FROM Ingredient WHERE id_ingredient = :id_ingredient";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id_ingredient', $id_ingredient, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            return new Ingredient($result['id_ingredient'], $result['nom'], $result['type']);
        }

        return null;
    }

    // Ajouter un nouvel ingrédient et récupérer son ID
    public function addIngredient(string $nom, string $type): ?int
    {
        $query = "INSERT INTO Ingredient (nom, type) VALUES (:nom, :type)";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
        $stmt->bindParam(':type', $type, PDO::PARAM_STR);

        if ($stmt->execute()) {
            // Récupérer l'ID du dernier ingrédient inséré
            return (int) $this->pdo->lastInsertId();
        }

        return null; // Retourne null en cas d'échec
    }

    // Récupérer tous les ingrédients
    public function getAllIngredients(): array
    {
        $query = "SELECT id_ingredient, nom, type FROM Ingredient";
        $stmt = $this->pdo->query($query);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $ingredients = [];
        foreach ($results as $row) {
            $ingredients[] = new Ingredient($row['id_ingredient'], $row['nom'], $row['type']);
        }

        return $ingredients;
    }
}
