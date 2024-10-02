<?php
require_once 'modules/blog/models/Repas/Repas.php';

/**
 * Classe RepasDao
 *
 * Data Access Object pour gérer les repas dans la base de données.
 */
class RepasDao
{
    private PDO $pdo; // Instance PDO pour la connexion à la base de données

    /**
     * Constructeur de la classe RepasDao.
     *
     * @param PDO $pdo Instance PDO pour la connexion à la base de données.
     */
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Récupère les derniers repas en fonction d'une limite donnée.
     *
     * @param int $limit Le nombre maximum de repas à récupérer.
     * @return array Liste des objets Repas.
     */
    public function getLastRepas(int $limit): array
    {
        $query = "SELECT id_repas, nom FROM Repas ORDER BY id_repas DESC LIMIT :limit";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $repas = [];
        foreach ($results as $result) {
            $repas[] = new Repas($result['id_repas'], $result['nom']);
        }

        return $repas;
    }

    /**
     * Récupère les prochains repas en fonction d'une limite donnée.
     *
     * @param int $limit Le nombre maximum de repas à récupérer.
     * @return array Liste des objets Repas.
     */
    public function getNextRepas(int $limit): array
    {
        $query = "SELECT id_repas, nom FROM Repas ORDER BY id_repas ASC LIMIT :limit";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $repas = [];
        foreach ($results as $result) {
            $repas[] = new Repas($result['id_repas'], $result['nom']);
        }

        return $repas;
    }

    /**
     * Récupère un repas par son identifiant.
     *
     * @param int $id L'ID du repas à récupérer.
     * @return Repas|null L'objet Repas correspondant ou null si non trouvé.
     */
    public function getRepasById(int $id): ?Repas
    {
        $query = "SELECT id_repas, nom FROM Repas WHERE id_repas = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            return new Repas($result['id_repas'], $result['nom']);
        }

        return null;
    }

    /**
     * Ajoute un nouveau repas à la base de données.
     *
     * @param string $nom Le nom du repas à ajouter.
     * @return bool True si l'ajout a réussi, false sinon.
     */
    public function addRepas(string $nom): bool
    {
        try {
            // Vérification de la longueur du nom de repas, ici 50 caractères
            if (strlen($nom) > 50) {
                throw new InvalidArgumentException('Le nom du repas est trop long (50 caractères max).');
            }

            // Insertion sans spécifier l'id_repas car il est auto-incrémenté
            $query = "INSERT INTO Repas (nom) VALUES (:nom)";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);

            // Exécuter l'insertion
            if (!$stmt->execute()) {
                error_log(print_r($stmt->errorInfo(), true));  // Log des erreurs
                return false;
            }

            return true;
        } catch (PDOException $e) {
            error_log('Erreur lors de l\'insertion : ' . $e->getMessage());
            return false;
        } catch (InvalidArgumentException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    /**
     * Récupère tous les repas de la base de données.
     *
     * @return array Liste des objets Repas.
     */
    public function getAllRepas(): array
    {
        $query = "SELECT id_repas, nom FROM Repas";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $repas = [];
        foreach ($results as $result) {
            $repas[] = new Repas($result['id_repas'], $result['nom']);
        }

        return $repas;
    }

    /**
     * Supprime un repas par son identifiant.
     *
     * @param int $id L'ID du repas à supprimer.
     * @return bool True si la suppression a réussi, false sinon.
     */
    public function deleteRepas(int $id): bool
    {
        try {
            $query = "DELETE FROM Repas WHERE id_repas = :id";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            return $stmt->execute();
        } catch (PDOException $e) {
            error_log('Erreur lors de la suppression : ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Met à jour un repas par son identifiant.
     *
     * @param int $id L'ID du repas à mettre à jour.
     * @param string $nom Le nouveau nom du repas.
     * @return bool True si la mise à jour a réussi, false sinon.
     */
    public function updateRepas(int $id, string $nom): bool
    {
        try {
            // Vérification de la longueur du nom de repas
            if (strlen($nom) > 50) {
                throw new InvalidArgumentException('Le nom du repas est trop long (50 caractères max).');
            }

            $query = "UPDATE Repas SET nom = :nom WHERE id_repas = :id";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            return $stmt->execute();
        } catch (PDOException $e) {
            error_log('Erreur lors de la mise à jour : ' . $e->getMessage());
            return false;
        } catch (InvalidArgumentException $e) {
            error_log($e->getMessage());
            return false;
        }
    }
}
?>
