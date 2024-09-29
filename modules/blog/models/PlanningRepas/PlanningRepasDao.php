<?php

require_once '/home/nael/Documents/web/tenrac/modules/blog/models/PlanningRepas/PlanningRepas.php';

class PlanningRepasDAO {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // Vérifie si la date existe dans Date_repas
    public function dateExists($date_repas) {
        $query = "SELECT COUNT(*) FROM Date_repas WHERE date_repas = :date_repas";
        $stmt = $this->db->prepare($query);
        $stmt->execute([':date_repas' => $date_repas]);
        return $stmt->fetchColumn() > 0;
    }

    // Ajoute une nouvelle date dans Date_repas
    public function addDateRepas($date_repas) {
        $query = "INSERT INTO Date_repas (date_repas) VALUES (:date_repas)";
        $stmt = $this->db->prepare($query);
        $stmt->execute([':date_repas' => $date_repas]);
    }

    // Ajoute un planning de repas
    public function addPlanningRepas($adresse, $date_repas, $id_repas, $horaire) {
        $query = "INSERT INTO Planning_repas (adresse, date_repas, id_repas, horaire) VALUES (:adresse, :date_repas, :id_repas, :horaire)";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([
            ':adresse' => $adresse,
            ':date_repas' => $date_repas,
            ':id_repas' => $id_repas,
            ':horaire' => $horaire
        ]);
    }

    // Récupère tous les plannings de repas
    public function getAllPlanningRepas() {
        $query = "SELECT * FROM Planning_repas";
        $stmt = $this->db->query($query);
        $repasList = [];

        // Créez un tableau d'objets PlanningRepas
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $repasList[] = new PlanningRepas($row['adresse'], $row['date_repas'], $row['id_repas'], (float)$row['horaire']);
        }
        
        return $repasList;
    }

    // Récupère un planning de repas par ID
    public function getPlanningRepasById($id) {
        $query = "SELECT * FROM Planning_repas WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->execute([':id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return new PlanningRepas($row['adresse'], $row['date_repas'], $row['id_repas'], (float)$row['horaire']);
    }

    // Met à jour un planning de repas
    public function updatePlanningRepas($id, $adresse, $date_repas, $id_repas, $horaire) {
        $query = "UPDATE Planning_repas SET adresse = :adresse, date_repas = :date_repas, id_repas = :id_repas, horaire = :horaire WHERE id = :id";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([
            ':id' => $id,
            ':adresse' => $adresse,
            ':date_repas' => $date_repas,
            ':id_repas' => $id_repas,
            ':horaire' => $horaire
        ]);
    }

    // Supprime un planning de repas
    public function deletePlanningRepas($id) {
        $query = "DELETE FROM Planning_repas WHERE id = :id";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([':id' => $id]);
    }
}
?>
