<?php

/**
 * Classe Repas
 *
 * Représente un repas avec ses attributs principaux.
 */
class Repas
{
    private int $id_repas; // Identifiant du repas
    private string $nom; // Nom du repas

    /**
     * Constructeur de la classe Repas.
     *
     * @param int $id_repas L'ID du repas.
     * @param string $nom Le nom du repas.
     */
    public function __construct(int $id_repas, string $nom)
    {
        $this->id_repas = $id_repas;
        $this->nom = $nom;
    }

    /**
     * Récupère l'identifiant du repas.
     *
     * @return int L'ID du repas.
     */
    public function getId(): int
    {
        return $this->id_repas;
    }

    /**
     * Récupère le nom du repas.
     *
     * @return string Le nom du repas.
     */
    public function getNom(): string
    {
        return $this->nom;
    }

    /**
     * Définit l'identifiant du repas.
     *
     * @param int $id_repas L'ID du repas à définir.
     * @return void
     */
    public function setId(int $id_repas): void
    {
        $this->id_repas = $id_repas;
    }

    /**
     * Définit le nom du repas.
     *
     * @param string $nom Le nom du repas à définir.
     * @return void
     */
    public function setNom(string $nom): void
    {
        $this->nom = $nom;
    }

    /**
     * Retourne une représentation sous forme de chaîne du repas.
     *
     * @return string Représentation sous forme de chaîne du repas.
     */
    public function __toString(): string
    {
        return "Repas ID: {$this->id_repas}, Nom: {$this->nom}";
    }
}
?>
