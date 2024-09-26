<?php
require_once 'modules/blog/models/DateRepas/DateRepas.php';

class DateRepasDAO
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    // Ajouter une nouvelle date de repas
    public function addDateRepas(string $date_repas): bool
    {
        $query = "INSERT INTO Date_repas (date_repas) VALUES (:date_repas)";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':date_repas', $date_repas, PDO::PARAM_STR);
        return $stmt->execute();
    }

    // Récupérer toutes les dates de repas
    public function getAllDateRepas(): array
    {
        $query = "SELECT date_repas FROM Date_repas";
        $stmt = $this->pdo->query($query);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $dates = [];
        foreach ($results as $row) {
            $dates[] = new DateRepas($row['date_repas']);
        }

        return $dates;
    }
}
