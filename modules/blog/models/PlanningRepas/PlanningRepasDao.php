<?php

require_once 'modules/blog/models/PlanningRepas/PlanningRepas.php';

/**
 * Classe PlanningRepasDAO
 *
 * Gère les opérations de la base de données concernant les plannings de repas.
 */
class PlanningRepasDAO {
    /**
     * @var PDO $db L'instance PDO pour la connexion à la base de données.
     */
    private $db;

    /**
     * Constructeur de la classe PlanningRepasDAO.
     *
     * @param PDO $db L'instance PDO pour la connexion à la base de données.
     */
    public function __construct($db) {
        $this->db = $db;
    }

    /**
     * Vérifie si la date existe dans Date_repas.
     *
     * @param string $date_repas La date à vérifier.
     * @return bool Retourne true si la date existe, sinon false.
     */
    public function dateExists($date_repas) {
        $query = "SELECT COUNT(*) FROM Date_repas WHERE date_repas = :date_repas";
        $stmt = $this->db->prepare($query);
        $stmt->execute([':date_repas' => $date_repas]);
        return $stmt->fetchColumn() > 0;
    }

    /**
     * Ajoute une nouvelle date dans Date_repas.
     *
     * @param string $date_repas La date à ajouter.
     * @return void
     */
    public function addDateRepas($date_repas) {
        $query = "INSERT INTO Date_repas (date_repas) VALUES (:date_repas)";
        $stmt = $this->db->prepare($query);
        $stmt->execute([':date_repas' => $date_repas]);
    }

    /**
     * Ajoute un planning de repas.
     *
     * @param string $adresse L'adresse du repas.
     * @param string $date_repas La date du repas.
     * @param int $id_repas L'ID du repas.
     * @param float $horaire L'horaire du repas.
     * @return bool Retourne true en cas de succès, sinon false.
     */
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

    /**
     * Récupère tous les plannings de repas.
     *
     * @return PlanningRepas[] Un tableau d'objets PlanningRepas.
     */
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

    /**
     * Récupère un planning de repas par ID.
     *
     * @param int $id L'ID du planning de repas à récupérer.
     * @return PlanningRepas|null Retourne un objet PlanningRepas si trouvé, sinon null.
     */
    public function getPlanningRepasById($id) {
        $query = "SELECT * FROM Planning_repas WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->execute([':id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $row ? new PlanningRepas($row['adresse'], $row['date_repas'], $row['id_repas'], (float)$row['horaire']) : null;
    }

    /**
     * Met à jour un planning de repas.
     *
     * @param int $id L'ID du planning de repas à mettre à jour.
     * @param string $adresse La nouvelle adresse du repas.
     * @param string $date_repas La nouvelle date du repas.
     * @param int $id_repas Le nouvel ID du repas.
     * @param float $horaire Le nouvel horaire du repas.
     * @return bool Retourne true en cas de succès, sinon false.
     */
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

    /**
     * Supprime un planning de repas.
     *
     * @param int $id L'ID du planning de repas à supprimer.
     * @return bool Retourne true en cas de succès, sinon false.
     */
    public function deletePlanningRepas($id) {
        $query = "DELETE FROM Planning_repas WHERE id = :id";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([':id' => $id]);
    }
}
?>
