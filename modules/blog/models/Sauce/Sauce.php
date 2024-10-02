<?php

/**
 * Classe Sauce
 *
 * Représente une sauce avec ses attributs principaux.
 */
class Sauce
{
    private int $id_sauce; // Identifiant de la sauce
    private string $nom; // Nom de la sauce

    /**
     * Constructeur de la classe Sauce.
     *
     * @param int $id_sauce L'ID de la sauce.
     * @param string $nom Le nom de la sauce.
     */
    public function __construct(int $id_sauce, string $nom)
    {
        $this->id_sauce = $id_sauce;
        $this->nom = $nom;
    }

    /**
     * Récupère l'identifiant de la sauce.
     *
     * @return int L'ID de la sauce.
     */
    public function getIdSauce(): int
    {
        return $this->id_sauce;
    }

    /**
     * Récupère le nom de la sauce.
     *
     * @return string Le nom de la sauce.
     */
    public function getNom(): string
    {
        return $this->nom;
    }

    /**
     * Définit l'identifiant de la sauce.
     *
     * @param int $id_sauce L'ID de la sauce à définir.
     * @return void
     */
    public function setIdSauce(int $id_sauce): void
    {
        $this->id_sauce = $id_sauce;
    }

    /**
     * Définit le nom de la sauce.
     *
     * @param string $nom Le nom de la sauce à définir.
     * @return void
     */
    public function setNom(string $nom): void
    {
        $this->nom = $nom;
    }

    /**
     * Retourne une représentation sous forme de chaîne de la sauce.
     *
     * @return string Représentation sous forme de chaîne de la sauce.
     */
    public function __toString(): string
    {
        return "Sauce ID: {$this->id_sauce}, Nom: {$this->nom}";
    }
}
?>
