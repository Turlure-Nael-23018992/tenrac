<?php
require_once 'modules/blog/models/Ordre/Ordre.php';

class OrdreDAO
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    // Ajouter un nouvel ordre et récupérer l'ID
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

    // Récupérer un ordre par ID
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

    // Récupérer tous les ordres
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
