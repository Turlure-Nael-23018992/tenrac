<?php

/**
 * Classe Aliment
 *
 * Représente un aliment avec un identifiant unique et un nom.
 */
class Aliment
{
    /**
     * @var int $id_aliment L'identifiant unique de l'aliment.
     */
    private int $id_aliment;

    /**
     * @var string $nom Le nom de l'aliment.
     */
    private string $nom;

    /**
     * Constructeur de la classe Aliment.
     *
     * @param int $id_aliment L'ID unique de l'aliment.
     * @param string $nom Le nom de l'aliment.
     */
    public function __construct(int $id_aliment, string $nom)
    {
        $this->id_aliment = $id_aliment;
        $this->nom = $nom;
    }

    /**
     * Obtenir l'ID de l'aliment.
     *
     * @return int Retourne l'ID de l'aliment.
     */
    public function getIdAliment(): int
    {
        return $this->id_aliment;
    }

    /**
     * Obtenir le nom de l'aliment.
     *
     * @return string Retourne le nom de l'aliment.
     */
    public function getNom(): string
    {
        return $this->nom;
    }

    /**
     * Définir un nouvel ID pour l'aliment.
     *
     * @param int $id_aliment L'ID de l'aliment à définir.
     * @return void
     */
    public function setIdAliment(int $id_aliment): void
    {
        $this->id_aliment = $id_aliment;
    }

    /**
     * Définir un nouveau nom pour l'aliment.
     *
     * @param string $nom Le nom de l'aliment à définir.
     * @return void
     */
    public function setNom(string $nom): void
    {
        $this->nom = $nom;
    }

    /**
     * Convertit l'instance d'Aliment en chaîne de caractères pour un affichage facile.
     *
     * @return string Retourne une représentation textuelle de l'aliment.
     */
    public function __toString(): string
    {
        return "Aliment ID: {$this->id_aliment}, Nom: {$this->nom}";
    }
}
?>
