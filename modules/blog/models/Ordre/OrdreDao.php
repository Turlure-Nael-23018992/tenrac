<?php
require_once 'modules/blog/models/Ordre/Ordre.php';

/**
 * Classe OrdreDAO
 *
 * Gère les opérations de la base de données concernant les ordres.
 */
class OrdreDAO
{
    /**
     * @var PDO $pdo L'instance PDO pour la connexion à la base de données.
     */
    private PDO $pdo;

    /**
     * Constructeur de la classe OrdreDAO.
     *
     * @param PDO $pdo L'instance PDO pour la connexion à la base de données.
     */
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Ajouter un nouvel ordre et récupérer l'ID.
     *
     * @param string $nom Le nom de l'ordre à ajouter.
     * @param string $description La description de l'ordre.
     * @return int|null Retourne l'ID de l'ordre ajouté ou null en cas d'échec.
     */
    public function addOrdre(string $nom, string $description): ?int
    {
        $query = "INSERT INTO Ordre (nom, description) VALUES (:nom, :description)";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
        $stmt->bindParam(':description', $description, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return (int) $this->pdo->lastInsertId();
        }

        return null;
    }

    /**
     * Récupérer un ordre par ID.
     *
     * @param int $id_ordre L'ID de l'ordre à récupérer.
     * @return Ordre|null Retourne un objet Ordre si trouvé, sinon null.
     */
    public function getOrdreById(int $id_ordre): ?Ordre
    {
        $query = "SELECT id_ordre, nom, description FROM Ordre WHERE id_ordre = :id_ordre";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id_ordre', $id_ordre, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            return new Ordre($result['id_ordre'], $result['nom'], $result['description']);
        }

        return null;
    }

    /**
     * Récupérer tous les ordres.
     *
     * @return Ordre[] Un tableau d'objets Ordre.
     */
    public function getAllOrdres(): array
    {
        $query = "SELECT id_ordre, nom, description FROM Ordre"; 
        $stmt = $this->pdo->query($query);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $ordresList = [];
        foreach ($results as $row) {
            $ordresList[] = new Ordre($row['id_ordre'], $row['nom'], $row['description']);
        }

        return $ordresList;
    }
}
?>
