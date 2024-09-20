<?php

class Plat
{
    private int $id_plat;
    private string $nom;

    public function __construct(int $id_plat, string $nom)
    {
        $this->id_plat = $id_plat;
        $this->nom = $nom;
    }

    public function getIdPlat(): int
    {
        return $this->id_plat;
    }

    public function getNom(): string
    {
        return $this->nom;
    }

    public function setIdPlat(int $id_plat): void
    {
        $this->id_plat = $id_plat;
    }

    public function setNom(string $nom): void
    {
        $this->nom = $nom;
    }

    public function __toString(): string
    {
        return "Plat ID: {$this->id_plat}, Nom: {$this->nom}";
    }
}
