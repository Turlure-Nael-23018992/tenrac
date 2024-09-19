<?php

class Sauce
{
    private int $id_sauce;
    private string $nom;

    public function __construct(int $id_sauce, string $nom)
    {
        $this->id_sauce = $id_sauce;
        $this->nom = $nom;
    }

    public function getIdSauce(): int
    {
        return $this->id_sauce;
    }

    public function getNom(): string
    {
        return $this->nom;
    }

    public function setIdSauce(int $id_sauce): void
    {
        $this->id_sauce = $id_sauce;
    }

    public function setNom(string $nom): void
    {
        $this->nom = $nom;
    }

    public function __toString(): string
    {
        return "Sauce ID: {$this->id_sauce}, Nom: {$this->nom}";
    }
}
