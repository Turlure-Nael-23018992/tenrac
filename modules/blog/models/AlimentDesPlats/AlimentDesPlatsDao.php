<?php
require_once 'modules/blog/models/AlimentDesPlats/AlimentDesPlats.php';

/**
 * Classe AlimentDesPlatsDAO
 *
 * Gère les opérations de la base de données pour la relation entre les aliments et les plats.
 */
class AlimentDesPlatsDAO
{
    /**
     * @var PDO $pdo Instance de PDO pour interagir avec la base de données.
     */
    private PDO $pdo;

    /**
     * Constructeur de la classe AlimentDesPlatsDAO.
     *
     * @param PDO $pdo Instance de PDO pour l'accès à la base de données.
     */
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Récupérer tous les aliments d'un plat donné par son ID.
     *
     * @param int $id_plat L'ID du plat dont on veut récupérer les aliments.
     * @return array Retourne un tableau contenant les ID des aliments associés au plat.
     */
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

    /**
     * Récupérer un aliment pour un plat donné, selon les ID du plat et de l'aliment.
     *
     * @param int $id_plat L'ID du plat.
     * @param int $id_aliment L'ID de l'aliment.
     * @return AlimentDesPlats|null Retourne une instance d'AlimentDesPlats si elle existe, sinon null.
     */
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

    /**
     * Ajouter une nouvelle relation entre un aliment et un plat.
     *
     * @param int $id_plat L'ID du plat.
     * @param int $id_aliment L'ID de l'aliment.
     * @return bool Retourne true si l'opération réussit, sinon false.
     */
    public function addAlimentDesPlats(int $id_plat, int $id_aliment): bool
    {
        $query = "INSERT INTO aliment_des_plats (id_plat, id_aliment) VALUES (:id_plat, :id_aliment)";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id_plat', $id_plat, PDO::PARAM_INT);
        $stmt->bindParam(':id_aliment', $id_aliment, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
?>
