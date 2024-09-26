<?php

class Ordre
{
    private int $id_ordre;
    private string $nom;
    private string $description;

    public function __construct(int $id_ordre, string $nom, string $description)
    {
        $this->id_ordre = $id_ordre;
        $this->nom = $nom;
        $this->description = $description;
    }

    public function getIdOrdre(): int
    {
        return $this->id_ordre;
    }

    public function getNom(): string
    {
        return $this->nom;
    }

    public function setIdOrdre(int $id_ordre): void
    {
        $this->id_ordre = $id_ordre;
    }

    public function setNom(string $nom): void
    {
        $this->nom = $nom;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function __toString(): string
    {
        return "Ordre ID: {$this->id_ordre}, Nom: {$this->nom}, Description: {$this->";
    }
}
