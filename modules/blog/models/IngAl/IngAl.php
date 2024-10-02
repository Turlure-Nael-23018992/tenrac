<?php

/**
 * Classe IngAl
 *
 * Représente la relation entre un ingrédient et un aliment.
 */
class IngAl
{
    /**
     * @var int $id_ingredient L'ID de l'ingrédient.
     */
    private int $id_ingredient;

    /**
     * @var int $id_aliment L'ID de l'aliment.
     */
    private int $id_aliment;

    /**
     * Constructeur de la classe IngAl.
     *
     * @param int $id_ingredient L'ID de l'ingrédient.
     * @param int $id_aliment L'ID de l'aliment.
     */
    public function __construct(int $id_ingredient, int $id_aliment)
    {
        $this->id_ingredient = $id_ingredient;
        $this->id_aliment = $id_aliment;
    }

    /**
     * Obtenir l'ID de l'ingrédient.
     *
     * @return int Retourne l'ID de l'ingrédient.
     */
    public function getIdIngredient(): int
    {
        return $this->id_ingredient;
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
     * Définir un nouvel ID pour l'ingrédient.
     *
     * @param int $id_ingredient L'ID de l'ingrédient.
     * @return void
     */
    public function setIdIngredient(int $id_ingredient): void
    {
        $this->id_ingredient = $id_ingredient;
    }

    /**
     * Définir un nouvel ID pour l'aliment.
     *
     * @param int $id_aliment L'ID de l'aliment.
     * @return void
     */
    public function setIdAliment(int $id_aliment): void
    {
        $this->id_aliment = $id_aliment;
    }

    /**
     * Conversion en chaîne pour un affichage facile.
     *
     * @return string Représentation de l'objet sous forme de chaîne.
     */
    public function __toString(): string
    {
        return "Ingrédient ID: {$this->id_ingredient}, Aliment ID: {$this->id_aliment}";
    }
}
?>
