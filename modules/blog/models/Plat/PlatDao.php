<?php

require_once 'modules/blog/models/Plat/Plat.php';

class PlatDao
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    // Récupérer un plat par ID
    public function getPlatById(int $id_plat): ?Plat
    {
        $query = "SELECT id_plat, nom FROM Plat WHERE id_plat = :id_plat";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id_plat', $id_plat, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            return new Plat($result['id_plat'], $result['nom']);
        }

        return null;
    }

    // Récupérer un plat par nom
    public function getPlatByNom(string $nom): ?Plat
    {
        $query = "SELECT id_plat, nom FROM Plat WHERE nom = :nom";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            return new Plat($result['id_plat'], $result['nom']);
        }

        return null;
    }
}
