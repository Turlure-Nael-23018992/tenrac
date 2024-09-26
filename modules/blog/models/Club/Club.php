<?php

class Club
{
    private int $id_club;
    private string $nom;
    private int $id_ordre;

    public function __construct(int $id_club, string $nom, int $id_ordre)
    {
        $this->id_club = $id_club;
        $this->nom = $nom;
        $this->id_ordre = $id_ordre;
    }

    public function getIdClub(): int
    {
        return $this->id_club;
    }

    public function getNom(): string
    {
        return $this->nom;
    }

    public function getIdOrdre(): int
    {
        return $this->id_ordre;
    }

    public function setIdClub(int $id_club): void
    {
        $this->id_club = $id_club;
    }

    public function setNom(string $nom): void
    {
        $this->nom = $nom;
    }

    public function setIdOrdre(int $id_ordre): void
    {
        $this->id_ordre = $id_ordre;
    }

    public function __toString(): string
    {
        return "Club ID: {$this->id_club}, Nom: {$this->nom}, Ordre ID: {$this->id_ordre}";
    }
}
