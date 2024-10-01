<?php
require_once 'modules/blog/models/PlatsRepas/PlatsRepas.php';

/**
 * Classe PlatsRepasDAO
 *
 * Data Access Object pour gérer les associations entre plats et repas.
 */
class PlatsRepasDAO
{
    private PDO $pdo; // Instance PDO pour la connexion à la base de données

    /**
     * Constructeur de la classe PlatsRepasDAO.
     *
     * @param PDO $pdo Instance PDO pour la connexion à la base de données.
     */
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Ajoute un nouveau plat à un repas.
     *
     * @param int $id_plat L'ID du plat à ajouter.
     * @param int $id_repas L'ID du repas auquel ajouter le plat.
     * @return bool True si l'ajout a réussi, false sinon.
     */
    public function addPlatRepas(int $id_plat, int $id_repas): bool
    {
        try {
            // Vérification des ID (id_plat et id_repas doivent être positifs)
            if ($id_plat <= 0 || $id_repas <= 0) {
                throw new InvalidArgumentException('Les id des plats/repas doivent être positifs.');
            }

            // Préparer la requête d'insertion
            $query = "INSERT INTO Plats_repas (id_plat, id_repas) VALUES (:id_plat, :id_repas)";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':id_plat', $id_plat, PDO::PARAM_INT);
            $stmt->bindParam(':id_repas', $id_repas, PDO::PARAM_INT);

            // Exécuter la requête et vérifier son succès
            if (!$stmt->execute()) {
                error_log(print_r($stmt->errorInfo(), true));
                return false;
            }

            return true;
        } catch (PDOException $e) {
            error_log('Erreur lors de l\'insertion dans Plats_repas : ' . $e->getMessage());
            return false;
        } catch (InvalidArgumentException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    /**
     * Récupère tous les plats associés à un repas.
     *
     * @param int $id_repas L'ID du repas.
     * @return array Liste des objets PlatsRepas associés au repas.
     */
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

    /**
     * Récupère tous les repas contenant un certain plat.
     *
     * @param int $id_plat L'ID du plat.
     * @return array Liste des objets PlatsRepas associés au plat.
     */
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
?>
