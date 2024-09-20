<?php

class RepasDao
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getRepasById(int $id): ?Repas
    {
        $query = "SELECT id, nom FROM Repas WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            return new Repas($result['id'], $result['nom']);
        }

        return null;
    }
}
