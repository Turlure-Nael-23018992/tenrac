<?php
require_once 'modules/blog/models/Lieux/Lieux.php';

/**
 * Classe LieuxDAO
 *
 * Gère les opérations de la base de données concernant les lieux.
 */
class LieuxDAO
{
    /**
     * @var PDO $pdo L'instance PDO pour la connexion à la base de données.
     */
    private PDO $pdo;

    /**
     * Constructeur de la classe LieuxDAO.
     *
     * @param PDO $pdo L'instance PDO pour la connexion à la base de données.
     */
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Ajouter un nouveau lieu et récupérer l'adresse.
     *
     * @param string $adresse L'adresse du lieu à ajouter.
     * @return bool Retourne vrai si l'ajout a réussi, sinon faux.
     */
    public function addLieux(string $adresse): bool
    {
        $query = "INSERT INTO Lieux (adresse) VALUES (:adresse)";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':adresse', $adresse, PDO::PARAM_STR);

        return $stmt->execute();
    }

    /**
     * Récupérer un lieu par adresse.
     *
     * @param string $adresse L'adresse du lieu à récupérer.
     * @return Lieux|null Retourne un objet Lieux si trouvé, sinon null.
     */
    public function getLieuxByAdresse(string $adresse): ?Lieux
    {
        $query = "SELECT adresse FROM Lieux WHERE adresse = :adresse";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':adresse', $adresse, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            return new Lieux($result['adresse']);
        }

        return null;
    }

    /**
     * Récupérer tous les lieux.
     *
     * @return Lieux[] Un tableau d'objets Lieux.
     */
    public function getAllLieux(): array
    {
        $query = "SELECT adresse FROM Lieux";
        $stmt = $this->pdo->query($query);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $lieuxList = [];
        foreach ($results as $row) {
            $lieuxList[] = new Lieux($row['adresse']);
        }

        return $lieuxList;
    }
}
?>
