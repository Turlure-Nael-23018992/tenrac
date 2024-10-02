<?php
require_once 'modules/blog/models/Ingredient/Ingredient.php';

/**
 * Classe IngredientDAO
 *
 * Fournit des méthodes pour interagir avec la base de données concernant les ingrédients.
 */
class IngredientDAO
{
    /**
     * @var PDO $pdo Instance de PDO pour la connexion à la base de données.
     */
    private PDO $pdo;

    /**
     * Constructeur de la classe IngredientDAO.
     *
     * @param PDO $pdo Instance de PDO.
     */
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Récupérer un ingrédient par son ID.
     *
     * @param int $id_ingredient L'ID de l'ingrédient à récupérer.
     * @return Ingredient|null Retourne l'objet Ingredient si trouvé, sinon null.
     */
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

    /**
     * Ajouter un nouvel ingrédient et récupérer son ID.
     *
     * @param string $nom Le nom de l'ingrédient.
     * @param string $type Le type de l'ingrédient.
     * @return int|null Retourne l'ID de l'ingrédient ajouté, ou null en cas d'échec.
     */
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

    /**
     * Récupérer tous les ingrédients.
     *
     * @return Ingredient[] Retourne un tableau d'objets Ingredient.
     */
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
?>
