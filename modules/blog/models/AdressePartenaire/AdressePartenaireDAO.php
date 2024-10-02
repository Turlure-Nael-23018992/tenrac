<?php
require_once 'modules/blog/models/AdressePartenaire/AdressePartenaire.php';

/**
 * Classe AdressePartenaireDAO
 *
 * Gère les opérations de récupération d'adresses partenaires depuis la base de données.
 */
class AdressePartenaireDAO
{
    /**
     * @var PDO $pdo Instance de PDO pour interagir avec la base de données.
     */
    private PDO $pdo;

    /**
     * Constructeur de la classe AdressePartenaireDAO.
     *
     * @param PDO $pdo Instance de PDO pour l'accès à la base de données.
     */
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Récupérer une adresse partenaire par l'ID de l'ordre.
     *
     * @param int $id_ordre L'ID de l'ordre pour récupérer l'adresse partenaire.
     * @return AdressePartenaire|null Retourne une instance d'AdressePartenaire si trouvé, sinon null.
     */
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

    /**
     * Récupérer une adresse partenaire par la chaîne d'adresse.
     *
     * @param string $adresse La chaîne de l'adresse pour récupérer l'adresse partenaire.
     * @return AdressePartenaire|null Retourne une instance d'AdressePartenaire si trouvé, sinon null.
     */
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
?>
