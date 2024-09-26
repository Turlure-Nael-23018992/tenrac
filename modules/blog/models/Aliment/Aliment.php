<?php

class Aliment
{
    private int $id_aliment;
    private string $nom;

    public function __construct(int $id_aliment, string $nom)
    {
        $this->id_aliment = $id_aliment;
        $this->nom = $nom;
    }

    // Getters
    public function getIdAliment(): int
    {
        return $this->id_aliment;
    }

    public function getNom(): string
    {
        return $this->nom;
    }

    // Setters
    public function setIdAliment(int $id_aliment): void
    {
        $this->id_aliment = $id_aliment;
    }

    public function setNom(string $nom): void
    {
        $this->nom = $nom;
    }

    // Conversion en chaîne pour un affichage facile
    public function __toString(): string
    {
        return "Aliment ID: {$this->id_aliment}, Nom: {$this->nom}";
    }
}
