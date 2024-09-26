<?php

class Ingredient
{
    private int $id_ingredient;
    private string $nom;
    private string $type;

    public function __construct(int $id_ingredient, string $nom, string $type)
    {
        $this->id_ingredient = $id_ingredient;
        $this->nom = $nom;
        $this->type = $type;
    }

    public function getIdIngredient(): int
    {
        return $this->id_ingredient;
    }

    public function getNom(): string
    {
        return $this->nom;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setIdIngredient(int $id_ingredient): void
    {
        $this->id_ingredient = $id_ingredient;
    }

    public function setNom(string $nom): void
    {
        $this->nom = $nom;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }

    public function __toString(): string
    {
        return "Ingredient ID: {$this->id_ingredient}, Nom: {$this->nom}, Type: {$this->type}";
    }
}
