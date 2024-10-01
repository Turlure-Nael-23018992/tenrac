<?php
require_once 'modules/blog/models/Aliment/Aliment.php';

/**
 * Classe AlimentDAO
 *
 * Gère les opérations de récupération d'aliments depuis la base de données.
 */
class AlimentDAO
{
    /**
     * @var PDO $pdo Instance de PDO pour interagir avec la base de données.
     */
    private PDO $pdo;

    /**
     * Constructeur de la classe AlimentDAO.
     *
     * @param PDO $pdo Instance de PDO pour l'accès à la base de données.
     */
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Récupérer un aliment par son ID.
     *
     * @param int $id_aliment L'ID de l'aliment à récupérer.
     * @return Aliment|null Retourne une instance d'Aliment si trouvé, sinon null.
     */
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

    /**
     * Récupérer un aliment par son nom.
     *
     * @param string $nom Le nom de l'aliment à récupérer.
     * @return Aliment|null Retourne une instance d'Aliment si trouvé, sinon null.
     */
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
?>
