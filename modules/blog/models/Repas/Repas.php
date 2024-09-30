<?php

class Repas
{
    private int $id_repas;
    private string $nom;

    public function __construct(int $id_repas, string $nom)
    {
        $this->id_repas = $id_repas;
        $this->nom = $nom;
    }

    public function getId(): int
    {
        return $this->id_repas;
    }

    public function getNom(): string
    {
        return $this->nom;
    }

    public function getIdRepas(): int
    {
        return $this->id_repas;
    }

    public function setId(int $id_repas): void
    {
        $this->id_repas = $id_repas;
    }

    public function setNom(string $nom): void
    {
        $this->nom = $nom;
    }

    public function __toString(): string
    {
        return "Repas ID: {$this->id_repas}, Nom: {$this->nom}";
    }
}
