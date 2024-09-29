<?php

class Repas
{
    private int $id_repas;
    private string $nom;

    public function __construct(int $id, string $nom)
    {
        $this->id_repas = $id;
        $this->nom = $nom;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getNom(): string
    {
        return $this->nom;
    }

    public function getIdRepas(): int
    {
        return $this->id_repas;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setNom(string $nom): void
    {
        $this->nom = $nom;
    }

    public function __toString(): string
    {
        return "Repas ID: {$this->id}, Nom: {$this->nom}";
    }
}
