<?php
require_once 'modules/blog/models/Saucing/Saucing.php';

/**
 * Classe SaucIngDAO
 *
 * Gère les opérations de base de données pour l'association entre les ingrédients et les sauces.
 */
class SaucIngDAO
{
    private PDO $pdo; // Instance de PDO pour interagir avec la base de données

    /**
     * Constructeur de la classe SaucIngDAO.
     *
     * @param PDO $pdo Instance de PDO pour accéder à la base de données.
     */
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Récupérer toutes les sauces pour un ingrédient donné.
     *
     * @param int $id_ingredient L'ID de l'ingrédient.
     * @return array Liste des IDs de sauces associées à l'ingrédient.
     */
    public function getSaucesByIngredientId(int $id_ingredient): array
    {
        $query = "SELECT id_sauce FROM sauc_ing WHERE id_ingredient = :id_ingredient";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id_ingredient', $id_ingredient, PDO::PARAM_INT);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Créer une liste de sauces
        $saucIngList = [];
        foreach ($results as $row) {
            $saucIngList[] = $row['id_sauce']; // Ajoute seulement l'ID de la sauce
        }

        return $saucIngList; // Retourne un tableau d'ID de sauces
    }

    /**
     * Récupérer tous les ingrédients d'une sauce.
     *
     * @param int $id_sauce L'ID de la sauce.
     * @return array Liste des IDs d'ingrédients associés à la sauce.
     */
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

    /**
     * Ajouter une nouvelle association ingrédient-sauce.
     *
     * @param int $id_ingredient L'ID de l'ingrédient.
     * @param int $id_sauce L'ID de la sauce.
     * @return bool True si l'insertion a réussi, sinon false.
     */
    public function addSauceToIngredient(int $id_ingredient, int $id_sauce): bool
    {
        $query = "INSERT INTO sauc_ing (id_ingredient, id_sauce) VALUES (:id_ingredient, :id_sauce)";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id_ingredient', $id_ingredient, PDO::PARAM_INT);
        $stmt->bindParam(':id_sauce', $id_sauce, PDO::PARAM_INT);
        return $stmt->execute(); // Exécute la requête d'insertion
    }
}
?>
