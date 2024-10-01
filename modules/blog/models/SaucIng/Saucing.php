<?php

/**
 * Classe SaucIng
 *
 * Représente l'association entre un ingrédient et une sauce.
 */
class SaucIng
{
    private int $id_ingredient; // Identifiant de l'ingrédient
    private int $id_sauce;      // Identifiant de la sauce

    /**
     * Constructeur de la classe SaucIng.
     *
     * @param int $id_ingredient L'ID de l'ingrédient.
     * @param int $id_sauce L'ID de la sauce.
     */
    public function __construct(int $id_ingredient, int $id_sauce)
    {
        $this->id_ingredient = $id_ingredient;
        $this->id_sauce = $id_sauce;
    }

    /**
     * Récupère l'identifiant de l'ingrédient.
     *
     * @return int L'ID de l'ingrédient.
     */
    public function getIdIngredient(): int
    {
        return $this->id_ingredient;
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
     * Définit l'identifiant de l'ingrédient.
     *
     * @param int $id_ingredient L'ID de l'ingrédient à définir.
     * @return void
     */
    public function setIdIngredient(int $id_ingredient): void
    {
        $this->id_ingredient = $id_ingredient;
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
     * Retourne une représentation sous forme de chaîne de l'association ingrédient-sauce.
     *
     * @return string Représentation sous forme de chaîne de l'association.
     */
    public function __toString(): string
    {
        return "Ingrédient ID: {$this->id_ingredient}, Sauce ID: {$this->id_sauce}";
    }
}
?>
