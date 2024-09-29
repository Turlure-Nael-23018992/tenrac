<?php

class Plat
{
    private int $id_plat;
    private string $nom;
    private ?string $lien_imageP; // Nouveau champ pour le lien de l'image

    public function __construct(int $id_plat, string $nom, ?string $lien_imageP = null)
    {
        $this->id_plat = $id_plat;
        $this->nom = $nom;
        $this->lien_imageP = $lien_imageP; // Initialisation du lien d'image
    }

    public function getIdPlat(): int
    {
        return $this->id_plat;
    }

    public function getNom(): string
    {
        return $this->nom;
    }

    public function getLienImageP(): ?string
    {
        return $this->lien_imageP; // Getter pour le lien d'image
    }

    public function setIdPlat(int $id_plat): void
    {
        $this->id_plat = $id_plat;
    }

    public function setNom(string $nom): void
    {
        $this->nom = $nom;
    }

    public function setLienImageP(?string $lien_imageP): void
    {
        $this->lien_imageP = $lien_imageP; // Setter pour le lien d'image
    }

    public function __toString(): string
    {
        return "Plat ID: {$this->id_plat}, Nom: {$this->nom}, Lien Image: {$this->lien_imageP}";
    }
}
?>
