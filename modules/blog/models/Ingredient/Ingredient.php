<?php

/**
 * Classe Ingredient
 *
 * Représente un ingrédient avec un ID, un nom et un type.
 */
class Ingredient
{
    /**
     * @var int $id_ingredient L'ID de l'ingrédient.
     */
    private int $id_ingredient;

    /**
     * @var string $nom Le nom de l'ingrédient.
     */
    private string $nom;

    /**
     * @var string $type Le type de l'ingrédient.
     */
    private string $type;

    /**
     * Constructeur de la classe Ingredient.
     *
     * @param int $id_ingredient L'ID de l'ingrédient.
     * @param string $nom Le nom de l'ingrédient.
     * @param string $type Le type de l'ingrédient.
     */
    public function __construct(int $id_ingredient, string $nom, string $type)
    {
        $this->id_ingredient = $id_ingredient;
        $this->nom = $nom;
        $this->type = $type;
    }

    /**
     * Récupérer l'ID de l'ingrédient.
     *
     * @return int L'ID de l'ingrédient.
     */
    public function getIdIngredient(): int
    {
        return $this->id_ingredient;
    }

    /**
     * Récupérer le nom de l'ingrédient.
     *
     * @return string Le nom de l'ingrédient.
     */
    public function getNom(): string
    {
        return $this->nom;
    }

    /**
     * Récupérer le type de l'ingrédient.
     *
     * @return string Le type de l'ingrédient.
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * Définir l'ID de l'ingrédient.
     *
     * @param int $id_ingredient L'ID de l'ingrédient.
     * @return void
     */
    public function setIdIngredient(int $id_ingredient): void
    {
        $this->id_ingredient = $id_ingredient;
    }

    /**
     * Définir le nom de l'ingrédient.
     *
     * @param string $nom Le nom de l'ingrédient.
     * @return void
     */
    public function setNom(string $nom): void
    {
        $this->nom = $nom;
    }

    /**
     * Définir le type de l'ingrédient.
     *
     * @param string $type Le type de l'ingrédient.
     * @return void
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    /**
     * Conversion en chaîne pour un affichage facile.
     *
     * @return string Représentation sous forme de chaîne de l'ingrédient.
     */
    public function __toString(): string
    {
        return "Ingredient ID: {$this->id_ingredient}, Nom: {$this->nom}, Type: {$this->type}";
    }
}
?>
