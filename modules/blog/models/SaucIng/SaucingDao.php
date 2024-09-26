<?php
require_once 'modules/blog/models/Saucing/Saucing.php';

class SaucIngDAO
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    // Récupérer toutes les sauces pour un ingrédient donné
    public function getSaucesByIngredientId(int $id_ingredient): array
    {
        $query = "SELECT id_sauce FROM sauc_ing WHERE id_ingredient = :id_ingredient";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id_ingredient', $id_ingredient, PDO::PARAM_INT);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $saucIngList = [];
        foreach ($results as $row) {
            $saucIngList[] = $row['id_sauce'];
        }

        return $saucIngList;
    }

    // Récupérer tous les ingrédients d'une sauce
    public function getIngredientBySauces(int $id_sauce): array
    {
        $query = "SELECT id_ingredient FROM sauc_ing WHERE id_sauce = :id_sauce";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id_sauce', $id_sauce, PDO::PARAM_INT);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Créer une liste d'ingrédients
        $ingredientsList = [];
        foreach ($results as $row) {
            $ingredientsList[] = $row['id_ingredient']; // Ajoute seulement l'ID de l'ingrédient
        }

        return $ingredientsList; // Retourne un tableau d'ID d'ingrédients
    }

    // Ajouter une nouvelle association ingrédient-sauce
    public function addSauceToIngredient(int $id_ingredient, int $id_sauce): bool
    {
        $query = "INSERT INTO sauc_ing (id_ingredient, id_sauce) VALUES (:id_ingredient, :id_sauce)";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id_ingredient', $id_ingredient, PDO::PARAM_INT);
        $stmt->bindParam(':id_sauce', $id_sauce, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
