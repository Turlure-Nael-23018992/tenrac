<?php

class IngAl
{
    private int $id_ingredient;
    private int $id_aliment;

    public function __construct(int $id_ingredient, int $id_aliment)
    {
        $this->id_ingredient = $id_ingredient;
        $this->id_aliment = $id_aliment;
    }

    public function getIdIngredient(): int
    {
        return $this->id_ingredient;
    }

    public function getIdAliment(): int
    {
        return $this->id_aliment;
    }

    public function setIdIngredient(int $id_ingredient): void
    {
        $this->id_ingredient = $id_ingredient;
    }

    public function setIdAliment(int $id_aliment): void
    {
        $this->id_aliment = $id_aliment;
    }

    public function __toString(): string
    {
        return "Ingrédient ID: {$this->id_ingredient}, Aliment ID: {$this->id_aliment}";
    }
}
