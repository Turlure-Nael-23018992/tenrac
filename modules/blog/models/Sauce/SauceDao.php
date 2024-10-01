<?php
require_once 'modules/blog/models/Sauce/Sauce.php';

/**
 * Classe SauceDAO
 *
 * Data Access Object pour gérer les sauces dans la base de données.
 */
class SauceDAO
{
    private PDO $pdo; // Instance PDO pour la connexion à la base de données

    /**
     * Constructeur de la classe SauceDAO.
     *
     * @param PDO $pdo Instance PDO pour la connexion à la base de données.
     */
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Récupère une sauce par son identifiant.
     *
     * @param int $id_sauce L'ID de la sauce à récupérer.
     * @return Sauce|null L'objet Sauce correspondant ou null si non trouvé.
     */
    public function getSauceById(int $id_sauce): ?Sauce
    {
        $query = "SELECT id_sauce, nom FROM Sauce WHERE id_sauce = :id_sauce";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id_sauce', $id_sauce, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            return new Sauce($result['id_sauce'], $result['nom']);
        }

        return null;
    }
}
?>
