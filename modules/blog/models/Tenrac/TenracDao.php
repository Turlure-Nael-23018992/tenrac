<?php
require_once 'modules/blog/models/Tenrac/Tenrac.php';

/**
 * Classe TenracDao
 *
 * Gère les opérations de base de données pour les tenracs.
 */
class TenracDao
{
    private PDO $pdo; // Instance de PDO pour interagir avec la base de données

    /**
     * Constructeur de la classe TenracDao.
     *
     * @param PDO $pdo Instance de PDO pour accéder à la base de données.
     */
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Récupérer les derniers tenracs.
     *
     * @param int $limit Le nombre de tenracs à récupérer.
     * @return array Liste des derniers tenracs.
     */
    public function getLastTenracs(int $limit): array
    {
        $query = "SELECT * FROM Tenrac ORDER BY id_tenrac DESC LIMIT :limit";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $tenracs = [];
        foreach ($results as $result) {
            $tenracs[] = new Tenrac(
                $result['id_tenrac'],
                $result['nom'],
                $result['couriel'],
                $result['tel'],
                $result['adresse'],
                $result['grade'],
                $result['id_club'],
                $result['id_ordre'],
                $result['rang'] ?? null,
                $result['titre'] ?? null,
                $result['dignite'] ?? null
            );
        }

        return $tenracs; // Retourne un tableau d'objets Tenrac
    }

    /**
     * Récupérer un tenrac par ID.
     *
     * @param int $id_tenrac L'ID du tenrac à récupérer.
     * @return Tenrac|null L'objet Tenrac si trouvé, sinon null.
     */
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
                $result['nom'],
                $result['couriel'],
                $result['tel'],
                $result['adresse'],
                $result['grade'],
                $result['id_club'],
                $result['id_ordre'],
                $result['rang'] ?? null,
                $result['titre'] ?? null,
                $result['dignite'] ?? null
            );
        }

        return null; // Retourne null si le tenrac n'est pas trouvé
    }

    /**
     * Récupérer un tenrac par nom.
     *
     * @param string $nom Le nom du tenrac à récupérer.
     * @return Tenrac|null L'objet Tenrac si trouvé, sinon null.
     */
    public function getTenracByNom(string $nom): ?Tenrac
    {
        $query = "SELECT * FROM Tenrac WHERE nom = :nom";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            return new Tenrac(
                $result['id_tenrac'],
                $result['nom'],
                $result['couriel'],
                $result['tel'],
                $result['adresse'],
                $result['grade'],
                $result['id_club'],
                $result['id_ordre'],
                $result['rang'] ?? null,
                $result['titre'] ?? null,
                $result['dignite'] ?? null
            );
        }

        return null; // Retourne null si le tenrac n'est pas trouvé
    }

    /**
     * Récupérer tous les tenracs.
     *
     * @return array Liste de tous les tenracs.
     */
    public function getAllTenracs(): array
    {
        $query = "SELECT * FROM Tenrac";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $tenracs = [];
        foreach ($results as $result) {
            $tenracs[] = new Tenrac(
                $result['id_tenrac'],
                $result['nom'],
                $result['couriel'],
                $result['tel'],
                $result['adresse'],
                $result['grade'],
                $result['id_club'],
                $result['id_ordre'],
                $result['rang'] ?? null,
                $result['titre'] ?? null,
                $result['dignite'] ?? null
            );
        }

        return $tenracs; // Retourne un tableau d'objets Tenrac
    }

    /**
     * Ajouter un tenrac.
     *
     * @param string $nom Le nom du tenrac.
     * @param string $couriel L'email du tenrac.
     * @param string $tel Le téléphone du tenrac.
     * @param string $adresse L'adresse du tenrac.
     * @param string $grade Le grade du tenrac.
     * @param int $id_club L'ID du club associé au tenrac.
     * @param int $id_ordre L'ID de l'ordre associé au tenrac.
     * @param string|null $rang Le rang du tenrac (facultatif).
     * @param string|null $titre Le titre du tenrac (facultatif).
     * @param string|null $dignite La dignité du tenrac (facultatif).
     * @return bool True si l'ajout a réussi, sinon false.
     */
    public function addTenrac(
        string $nom,
        string $couriel,
        string $tel,
        string $adresse,
        string $grade,
        int $id_club,
        int $id_ordre,
        ?string $rang = null,
        ?string $titre = null,
        ?string $dignite = null
    ): bool {
        try {
            $query = "INSERT INTO Tenrac (nom, couriel, tel, adresse, grade, id_club, id_ordre, rang, titre, dignite) 
                      VALUES (:nom, :couriel, :tel, :adresse, :grade, :id_club, :id_ordre, :rang, :titre, :dignite)";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
            $stmt->bindParam(':couriel', $couriel, PDO::PARAM_STR);
            $stmt->bindParam(':tel', $tel, PDO::PARAM_STR);
            $stmt->bindParam(':adresse', $adresse, PDO::PARAM_STR);
            $stmt->bindParam(':grade', $grade, PDO::PARAM_STR);
            $stmt->bindParam(':id_club', $id_club, PDO::PARAM_INT);
            $stmt->bindParam(':id_ordre', $id_ordre, PDO::PARAM_INT);
            $stmt->bindParam(':rang', $rang, PDO::PARAM_STR);
            $stmt->bindParam(':titre', $titre, PDO::PARAM_STR);
            $stmt->bindParam(':dignite', $dignite, PDO::PARAM_STR);

            return $stmt->execute(); // Exécute la requête d'insertion
        } catch (PDOException $e) {
            echo 'Erreur lors de l\'insertion : ' . $e->getMessage();
            return false; // Retourne false en cas d'erreur
        }
    }

    /**
     * Éditer un tenrac.
     *
     * @param int $id_tenrac L'ID du tenrac à éditer.
     * @param string $nom Le nouveau nom du tenrac.
     * @param string $couriel Le nouvel email du tenrac.
     * @param string $tel Le nouveau téléphone du tenrac.
     * @param string $adresse La nouvelle adresse du tenrac.
     * @param string $grade Le nouveau grade du tenrac.
     * @param int $id_club Le nouvel ID du club associé au tenrac.
     * @param string|null $rang Le nouveau rang du tenrac (facultatif).
     * @param string|null $titre Le nouveau titre du tenrac (facultatif).
     * @param string|null $dignite La nouvelle dignité du tenrac (facultatif).
     * @return bool True si la mise à jour a réussi, sinon false.
     */
    public function editTenrac(
        int $id_tenrac,
        string $nom,
        string $couriel,
        string $tel,
        string $adresse,
        string $grade,
        int $id_club,
        ?string $rang = null,
        ?string $titre = null,
        ?string $dignite = null
    ): bool {
        $query = "UPDATE Tenrac 
                  SET nom = :nom, couriel = :couriel, tel = :tel, adresse = :adresse, 
                      grade = :grade, id_club = :id_club, rang = :rang, titre = :titre, dignite = :dignite 
                  WHERE id_tenrac = :id_tenrac";
        $stmt = $this->pdo->prepare($query);
        
        $stmt->bindParam(':id_tenrac', $id_tenrac, PDO::PARAM_INT);
        $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
        $stmt->bindParam(':couriel', $couriel, PDO::PARAM_STR);
        $stmt->bindParam(':tel', $tel, PDO::PARAM_STR);
        $stmt->bindParam(':adresse', $adresse, PDO::PARAM_STR);
        $stmt->bindParam(':grade', $grade, PDO::PARAM_STR);
        $stmt->bindParam(':id_club', $id_club, PDO::PARAM_INT);
        $stmt->bindParam(':rang', $rang, PDO::PARAM_STR);
        $stmt->bindParam(':titre', $titre, PDO::PARAM_STR);
        $stmt->bindParam(':dignite', $dignite, PDO::PARAM_STR);

        return $stmt->execute(); // Exécute la requête de mise à jour
    }

    /**
     * Supprimer un tenrac par ID.
     *
     * @param int $id_tenrac L'ID du tenrac à supprimer.
     * @return bool True si la suppression a réussi, sinon false.
     */
    public function deleteTenracById(int $id_tenrac): bool
    {
        $query = "DELETE FROM Tenrac WHERE id_tenrac = :id_tenrac";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id_tenrac', $id_tenrac, PDO::PARAM_INT);

        return $stmt->execute(); // Exécute la requête de suppression
    }
}
?>
