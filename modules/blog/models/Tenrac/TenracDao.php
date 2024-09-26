<?php

class TenracDAO
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    // Récupérer un Tenrac par ID
    public function getTenracById(int $id_tenrac): ?Tenrac
    {
        $query = "SELECT * FROM Tenrac WHERE id_tenrac = :id_tenrac";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id_tenrac', $id_tenrac, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            return new Tenrac(
                $result['id_tenrac'],
                $result['courriel'],
                $result['tel'],
                $result['grade'],
                $result['rang'],
                $result['titre'],
                $result['dignite'],
                $result['nom'],
                $result['adresse'],
                $result['motdepasse'],
                $result['id_club'],
                $result['id_ordre']
            );
        }
        return null;
    }

    // Récupérer tous les Tenrac
    public function getAllTenracs(): array
    {
        $query = "SELECT * FROM Tenrac";
        $stmt = $this->pdo->query($query);
        $tenracs = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $tenracs[] = new Tenrac(
                $row['id_tenrac'],
                $row['courriel'],
                $row['tel'],
                $row['grade'],
                $row['rang'],
                $row['titre'],
                $row['dignite'],
                $row['nom'],
                $row['adresse'],
                $row['motdepasse'],
                $row['id_club'],
                $row['id_ordre']
            );
        }

        return $tenracs;
    }
}
