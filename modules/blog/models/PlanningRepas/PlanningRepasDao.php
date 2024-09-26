<?php
require_once 'modules/blog/models/PlanningRepas/PlanningRepas.php';

class PlanningRepasDAO
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    // Ajouter un nouveau planning de repas
    public function addPlanningRepas(string $adresse, string $date_repas, int $id_repas, float $horaire): bool
    {
        $query = "INSERT INTO Planning_repas (adresse, date_repas, id_repas, horaire) VALUES (:adresse, :date_repas, :id_repas, :horaire)";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':adresse', $adresse, PDO::PARAM_STR);
        $stmt->bindParam(':date_repas', $date_repas, PDO::PARAM_STR);
        $stmt->bindParam(':id_repas', $id_repas, PDO::PARAM_INT);
        $stmt->bindParam(':horaire', $horaire, PDO::PARAM_STR); // Horaire sous forme de chaîne pour la précision décimale

        return $stmt->execute();
    }

    // Récupérer un planning de repas par adresse, ID du repas et date du repas
    public function getPlanningRepasById(string $adresse, int $id_repas, string $date_repas): ?PlanningRepas
    {
        $query = "SELECT adresse, date_repas, id_repas, horaire FROM Planning_repas 
                  WHERE adresse = :adresse AND id_repas = :id_repas AND date_repas = :date_repas";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':adresse', $adresse, PDO::PARAM_STR);
        $stmt->bindParam(':id_repas', $id_repas, PDO::PARAM_INT);
        $stmt->bindParam(':date_repas', $date_repas, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            return new PlanningRepas($result['adresse'], $result['date_repas'], $result['id_repas'], (float) $result['horaire']);
        }

        return null;
    }

    // Récupérer tous les planning de repas par adresse
    public function getPlanningRepasByAdresse(string $adresse): array
    {
        $query = "SELECT adresse, date_repas, id_repas, horaire FROM Planning_repas WHERE adresse = :adresse";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':adresse', $adresse, PDO::PARAM_STR);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        $planningList = [];
        foreach ($results as $row) {
            $planningList[] = new PlanningRepas($row['adresse'], $row['date_repas'], $row['id_repas'], (float) $row['horaire']);
        }
    
        return $planningList;
    }

    // Récupérer tous les planning de repas par date
    public function getPlanningRepasByDate(string $date_repas): array
    {
        $query = "SELECT adresse, date_repas, id_repas, horaire FROM Planning_repas WHERE date_repas = :date_repas";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':date_repas', $date_repas, PDO::PARAM_STR);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        $planningList = [];
        foreach ($results as $row) {
            $planningList[] = new PlanningRepas($row['adresse'], $row['date_repas'], $row['id_repas'], (float) $row['horaire']);
        }
    
        return $planningList;
    }

        // Récupérer tous les planning de repas par le repas
    public function getPlanningRepasByRepas(string $date_repas): array
    {
        $query = "SELECT adresse, date_repas, id_repas, horaire FROM Planning_repas WHERE id_repas = :id_repas";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id_repas', $id_repas, PDO::PARAM_STR);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        $planningList = [];
        foreach ($results as $row) {
            $planningList[] = new PlanningRepas($row['adresse'], $row['date_repas'], $row['id_repas'], (float) $row['horaire']);
        }
    
        return $planningList;
    }

    // Récupérer tous les plannings de repas
    public function getAllPlanningRepas(): array
    {
        $query = "SELECT adresse, date_repas, id_repas, horaire FROM Planning_repas";
        $stmt = $this->pdo->query($query);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $planningList = [];
        foreach ($results as $row) {
            $planningList[] = new PlanningRepas($row['adresse'], $row['date_repas'], $row['id_repas'], (float) $row['horaire']);
        }

        return $planningList;
    }
}
