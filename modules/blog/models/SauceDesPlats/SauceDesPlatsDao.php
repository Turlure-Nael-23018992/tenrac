<?php
require_once 'modules/blog/models/SauceDesPlats/SauceDesPlats.php';

/**
 * Classe SauceDesPlatDAO
 *
 * Data Access Object pour gérer les associations entre plats et sauces dans la base de données.
 */
class SauceDesPlatDAO
{
    private PDO $pdo; // Instance PDO pour la connexion à la base de données

    /**
     * Constructeur de la classe SauceDesPlatDAO.
     *
     * @param PDO $pdo Instance PDO pour la connexion à la base de données.
     */
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Récupère toutes les sauces pour un plat donné.
     *
     * @param int $id_plat L'ID du plat pour lequel récupérer les sauces.
     * @return array Liste des ID de sauces associées au plat.
     */
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

    /**
     * Ajoute une nouvelle association plat-sauce.
     *
     * @param int $id_plat L'ID du plat.
     * @param int $id_sauce L'ID de la sauce.
     * @return bool True si l'association a été ajoutée avec succès, sinon false.
     */
    public function addSauceToPlat(int $id_plat, int $id_sauce): bool
    {
        $query = "INSERT INTO sauce_des_plat (id_plat, id_sauce) VALUES (:id_plat, :id_sauce)";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id_plat', $id_plat, PDO::PARAM_INT);
        $stmt->bindParam(':id_sauce', $id_sauce, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
?>
