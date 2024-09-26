<?php

class AdressePartenaireDAO
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    // Récupérer une adresse par id_ordre
    public function getAdresseByIdOrdre(int $id_ordre): ?AdressePartenaire
    {
        $query = "SELECT id_ordre, adresse FROM adresse_partenaire WHERE id_ordre = :id_ordre";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id_ordre', $id_ordre, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            return new AdressePartenaire($result['id_ordre'], $result['adresse']);
        }

        return null;
    }

    // Récupérer une adresse par chaîne d'adresse
    public function getAdresseByAdresse(string $adresse): ?AdressePartenaire
    {
        $query = "SELECT id_ordre, adresse FROM adresse_partenaire WHERE adresse = :adresse";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':adresse', $adresse, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            return new AdressePartenaire($result['id_ordre'], $result['adresse']);
        }

        return null;
    }
}
