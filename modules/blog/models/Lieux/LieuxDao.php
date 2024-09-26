<?php
require_once 'modules/blog/models/Lieux/Lieux.php';

class LieuxDAO
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    // Ajouter un nouveau lieu et récupérer l'adresse
    public function addLieux(string $adresse): bool
    {
        $query = "INSERT INTO Lieux (adresse) VALUES (:adresse)";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':adresse', $adresse, PDO::PARAM_STR);

        return $stmt->execute();
    }

    // Récupérer un lieu par adresse
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

    // Récupérer tous les lieux
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
