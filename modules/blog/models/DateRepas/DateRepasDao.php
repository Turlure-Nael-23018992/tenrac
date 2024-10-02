<?php
require_once 'modules/blog/models/DateRepas/DateRepas.php';

/**
 * Classe DateRepasDAO
 *
 * Fournit des méthodes pour interagir avec les dates de repas dans la base de données.
 */
class DateRepasDAO
{
    /**
     * @var PDO $pdo Instance de la connexion PDO à la base de données.
     */
    private PDO $pdo;

    /**
     * Constructeur de la classe DateRepasDAO.
     *
     * @param PDO $pdo Instance de la connexion PDO.
     */
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Ajouter une nouvelle date de repas.
     *
     * @param string $date_repas La date du repas à ajouter.
     * @return bool Retourne true en cas de succès, sinon false.
     */
    public function addDateRepas(string $date_repas): bool
    {
        $query = "INSERT INTO Date_repas (date_repas) VALUES (:date_repas)";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':date_repas', $date_repas, PDO::PARAM_STR);
        return $stmt->execute();
    }

    /**
     * Récupérer toutes les dates de repas.
     *
     * @return DateRepas[] Un tableau d'objets DateRepas.
     */
    public function getAllDateRepas(): array
    {
        $query = "SELECT date_repas FROM Date_repas";
        $stmt = $this->pdo->query($query);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $dates = [];
        foreach ($results as $row) {
            $dates[] = new DateRepas($row['date_repas']);
        }

        return $dates; // Retourne un tableau d'objets DateRepas
    }
}
?>
