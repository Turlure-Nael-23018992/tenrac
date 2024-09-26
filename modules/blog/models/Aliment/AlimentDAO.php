<?php
require_once 'modules/blog/models/Aliment/Aliment.php';

class AlimentDAO
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    // Récupérer un aliment par ID
    public function getAlimentById(int $id_aliment): ?Aliment
    {
        $query = "SELECT id_aliment, nom FROM Aliment WHERE id_aliment = :id_aliment";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id_aliment', $id_aliment, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            return new Aliment($result['id_aliment'], $result['nom']);
        }

        return null;
    }

    // Récupérer un aliment par nom
    public function getAlimentByNom(string $nom): ?Aliment
    {
        $query = "SELECT id_aliment, nom FROM Aliment WHERE nom = :nom";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            return new Aliment($result['id_aliment'], $result['nom']);
        }

        return null;
    }
}
