<?php

class SaucIng
{
    private int $id_ingredient;
    private int $id_sauce;

    public function __construct(int $id_ingredient, int $id_sauce)
    {
        $this->id_ingredient = $id_ingredient;
        $this->id_sauce = $id_sauce;
    }

    public function getIdIngredient(): int
    {
        return $this->id_ingredient;
    }

    public function getIdSauce(): int
    {
        return $this->id_sauce;
    }

    public function setIdIngredient(int $id_ingredient): void
    {
        $this->id_ingredient = $id_ingredient;
    }

    public function setIdSauce(int $id_sauce): void
    {
        $this->id_sauce = $id_sauce;
    }

    public function __toString(): string
    {
        return "Ingrédient ID: {$this->id_ingredient}, Sauce ID: {$this->id_sauce}";
    }
}
