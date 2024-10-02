<?php

/**
 * Classe AdressePartenaire
 *
 * Représente une adresse partenaire avec un ID d'ordre et une adresse.
 */
class AdressePartenaire
{
    /**
     * @var int $id_ordre L'identifiant de l'ordre pour l'adresse partenaire.
     */
    private int $id_ordre;

    /**
     * @var string $adresse La chaîne de l'adresse partenaire.
     */
    private string $adresse;

    /**
     * Constructeur de la classe AdressePartenaire.
     *
     * @param int $id_ordre L'ID de l'ordre pour l'adresse.
     * @param string $adresse La chaîne représentant l'adresse.
     */
    public function __construct(int $id_ordre, string $adresse)
    {
        $this->id_ordre = $id_ordre;
        $this->adresse = $adresse;
    }

    /**
     * Obtenir l'ID de l'ordre associé à l'adresse partenaire.
     *
     * @return int Retourne l'ID de l'ordre.
     */
    public function getIdOrdre(): int
    {
        return $this->id_ordre;
    }

    /**
     * Obtenir la chaîne de l'adresse partenaire.
     *
     * @return string Retourne l'adresse sous forme de chaîne.
     */
    public function getAdresse(): string
    {
        return $this->adresse;
    }

    /**
     * Définir l'ID de l'ordre pour l'adresse partenaire.
     *
     * @param int $id_ordre L'ID de l'ordre à définir.
     * @return void
     */
    public function setIdOrdre(int $id_ordre): void
    {
        $this->id_ordre = $id_ordre;
    }

    /**
     * Définir la chaîne de l'adresse partenaire.
     *
     * @param string $adresse La nouvelle adresse à définir.
     * @return void
     */
    public function setAdresse(string $adresse): void
    {
        $this->adresse = $adresse;
    }

    /**
     * Convertit l'instance de l'objet en chaîne de caractères.
     *
     * @return string Retourne une représentation de l'objet en tant que chaîne.
     */
    public function __toString(): string
    {
        return "Adresse ID Ordre: {$this->id_ordre}, Adresse: {$this->adresse}";
    }
}
?>
