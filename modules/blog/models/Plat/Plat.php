<?php

/**
 * Classe Plat
 *
 * Représente un plat avec un identifiant, un nom et un lien d'image.
 */
class Plat
{
    private int $id_plat; // Identifiant du plat
    private string $nom; // Nom du plat
    private ?string $lien_imageP; // Lien de l'image du plat

    /**
     * Constructeur de la classe Plat.
     *
     * @param int $id_plat L'ID du plat.
     * @param string $nom Le nom du plat.
     * @param string|null $lien_imageP Le lien de l'image du plat (peut être null).
     */
    public function __construct(int $id_plat, string $nom, ?string $lien_imageP = null)
    {
        $this->id_plat = $id_plat;
        $this->nom = $nom;
        $this->lien_imageP = $lien_imageP; // Initialisation du lien d'image
    }

    /**
     * Récupère l'identifiant du plat.
     *
     * @return int L'ID du plat.
     */
    public function getIdPlat(): int
    {
        return $this->id_plat;
    }

    /**
     * Récupère le nom du plat.
     *
     * @return string Le nom du plat.
     */
    public function getNom(): string
    {
        return $this->nom;
    }

    /**
     * Récupère le lien de l'image du plat.
     *
     * @return string|null Le lien de l'image du plat, ou null s'il n'existe pas.
     */
    public function getLienImageP(): ?string
    {
        return $this->lien_imageP; // Getter pour le lien d'image
    }

    /**
     * Définit l'identifiant du plat.
     *
     * @param int $id_plat L'ID du plat à définir.
     * @return void
     */
    public function setIdPlat(int $id_plat): void
    {
        $this->id_plat = $id_plat;
    }

    /**
     * Définit le nom du plat.
     *
     * @param string $nom Le nom du plat à définir.
     * @return void
     */
    public function setNom(string $nom): void
    {
        $this->nom = $nom;
    }

    /**
     * Définit le lien de l'image du plat.
     *
     * @param string|null $lien_imageP Le lien de l'image à définir (peut être null).
     * @return void
     */
    public function setLienImageP(?string $lien_imageP): void
    {
        $this->lien_imageP = $lien_imageP; // Setter pour le lien d'image
    }

    /**
     * Retourne une représentation sous forme de chaîne du plat.
     *
     * @return string Représentation sous forme de chaîne du plat.
     */
    public function __toString(): string
    {
        return "Plat ID: {$this->id_plat}, Nom: {$this->nom}, Lien Image: {$this->lien_imageP}";
    }
}
?>
