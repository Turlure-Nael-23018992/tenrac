<?php

require_once 'modules/blog/models/Plat/Plat.php';
require_once 'modules/blog/models/Ingredient/Ingredient.php';

/**
 * Classe PlatDao
 *
 * Gère les opérations de la base de données concernant les plats.
 */
class PlatDao
{
    /**
     * @var PDO $pdo Instance de PDO pour la connexion à la base de données.
     */
    private PDO $pdo;

    /**
     * Constructeur de la classe PlatDao.
     *
     * @param PDO $pdo Instance de PDO pour la connexion à la base de données.
     */
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Récupérer un plat par ID.
     *
     * @param int $id_plat L'ID du plat à récupérer.
     * @return Plat|null Un objet Plat si trouvé, sinon null.
     */
    public function getPlatById(int $id_plat): ?Plat
    {
        $query = "SELECT id_plat, nom, lien_imageP FROM Plat WHERE id_plat = :id_plat";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id_plat', $id_plat, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            return new Plat($result['id_plat'], $result['nom'], $result['lien_imageP']);
        }

        return null;
    }
    /**
     * Récupérer les ingrédients d'un plat par l'ID .
     *
     * @param int $id_plat L'ID du plat à récupérer.
     * @return array Des ingrédients si trouvé.
     */
    public function getIngredientByIdPlat($id_plat) : array
{
    $query = "SELECT i.id_ingredient, i.nom, i.type 
              FROM Ingredient i 
              JOIN Plat_Ingredient pi ON i.id_ingredient = pi.id_ingredient 
              WHERE pi.id_plat = :id_plat";
    $stmt = $this->pdo->prepare($query);
    $stmt->bindParam(':id_plat', $id_plat, PDO::PARAM_INT);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $ingredients = [];
    foreach ($results as $result) {
        // Créer un objet Ingredient pour chaque résultat de la base de données
        $ingredients[] = new Ingredient($result['id_ingredient'], $result['nom'], $result['type']);
    }

    return $ingredients;
}

    /**
     * Récupérer un plat par nom.
     *
     * @param string $nom Le nom du plat à récupérer.
     * @return Plat|null Un objet Plat si trouvé, sinon null.
     */
    public function getPlatByNom(string $nom): ?Plat
    {
        $query = "SELECT id_plat, nom, lien_imageP FROM Plat WHERE nom = :nom";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            return new Plat($result['id_plat'], $result['nom'], $result['lien_imageP']);
        }

        return null;
    }

    /**
     * Récupérer les derniers plats.
     *
     * @param int $limit Le nombre de plats à récupérer.
     * @return Plat[] Un tableau d'objets Plat.
     */
    public function getLastPlats(int $limit): array
    {
        $query = "SELECT id_plat, nom, lien_imageP FROM Plat ORDER BY id_plat DESC LIMIT :limit";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $plats = [];
        foreach ($results as $result) {
            $plats[] = new Plat($result['id_plat'], $result['nom'], $result['lien_imageP']);
        }

        return $plats;
    }

    /**
     * Ajouter un plat.
     *
     * @param string $nom Le nom du plat.
     * @param string|null $lien_imageP Le lien de l'image du plat (peut être null).
     * @return bool Retourne true en cas de succès, sinon false.
     */
    public function addPlat(string $nom, ?string $lien_imageP): bool
    {
        try {
            $query = "INSERT INTO Plat (nom, lien_imageP) VALUES (:nom, :lien_imageP)";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
            $stmt->bindParam(':lien_imageP', $lien_imageP, PDO::PARAM_STR);

            return $stmt->execute();
        } catch (PDOException $e) {
            echo 'Erreur lors de l\'insertion : ' . $e->getMessage();
            return false;
        }
    }

    /**
     * Supprime un plat par ID.
     *
     * @param int $id_plat L'ID du plat à supprimer.
     * @return bool Retourne true en cas de succès, sinon false.
     */
    public function deletePlatById(int $id_plat): bool
    {
        $query = "DELETE FROM Plat WHERE id_plat = :id_plat";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id_plat', $id_plat, PDO::PARAM_INT);

        return $stmt->execute();
    }

    /**
     * Édite un plat.
     *
     * @param int $id_plat L'ID du plat à éditer.
     * @param string $nom_plat Le nouveau nom du plat.
     * @param string|null $lien_imageP Le nouveau lien de l'image du plat (peut être null).
     * @return bool Retourne true en cas de succès, sinon false.
     */
    public function editPlat(int $id_plat, string $nom_plat, ?string $lien_imageP): bool
    {
        // Préparez la requête SQL pour mettre à jour le plat
        $sql = "UPDATE Plat SET nom = :nom, lien_imageP = :lien_imageP WHERE id_plat = :id_plat";
        $stmt = $this->pdo->prepare($sql);
        
        // Liez les paramètres
        $stmt->bindParam(':nom', $nom_plat, PDO::PARAM_STR);
        $stmt->bindParam(':lien_imageP', $lien_imageP, PDO::PARAM_STR);
        $stmt->bindParam(':id_plat', $id_plat, PDO::PARAM_INT);
        
        // Exécutez la requête
        return $stmt->execute();
    }

    /**
     * Récupère tous les plats.
     *
     * @return Plat[] Un tableau d'objets Plat.
     */
    public function getAllPlats(): array
    {
        $query = "SELECT id_plat, nom, lien_imageP FROM Plat";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $plats = [];
        foreach ($results as $result) {
            $plats[] = new Plat($result['id_plat'], $result['nom'], $result['lien_imageP']);
        }

        return $plats;
    }

    /**
     * Récupère l'instance de PDO.
     *
     * @return PDO L'instance de PDO.
     */
    public function getPdo() {
        return $this->pdo;
    }

    /**
     * Récupère les plats par ingrédients.
     *
     * @param array $ingredients Un tableau des noms d'ingrédients.
     * @return Plat[] Un tableau d'objets Plat correspondant aux ingrédients spécifiés.
     */
    public function getPlatsParIngredients(array $ingredients = []): array {
        $query = "SELECT DISTINCT p.id_plat, p.nom, p.lien_imageP 
                  FROM Plat p 
                  JOIN Plat_Ingredient pi ON p.id_plat = pi.id_plat
                  JOIN Ingredient i ON pi.id_ingredient = i.id_ingredient";

        if (!empty($ingredients)) {
            $placeholders = array_fill(0, count($ingredients), '?');
            $query .= " WHERE i.nom IN (" . implode(',', $placeholders) . ")";
        }

        // Préparer la requête avec l'objet PDO
        $stmt = $this->pdo->prepare($query);
        $stmt->execute($ingredients);

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $plats = [];
        foreach ($results as $result) {
            $plats[] = new Plat($result['id_plat'], $result['nom'], $result['lien_imageP']);
        }

        return $plats;
    }
}
?>
