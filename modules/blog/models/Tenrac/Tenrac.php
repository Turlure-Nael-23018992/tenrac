<?php

class Tenrac
{
    private int $id_tenrac;
    private string $nom;
    private string $couriel;
    private string $tel;
    private string $adresse;
    private string $grade;
    private int $id_club;
    private int $id_ordre;
    private ?string $rang;
    private ?string $titre;
    private ?string $dignite;

    public function __construct(
        int $id_tenrac,
        string $nom,
        string $couriel,
        string $tel,
        string $adresse,
        string $grade,
        int $id_club,
        int $id_ordre,
        ?string $rang = null,
        ?string $titre = null,
        ?string $dignite = null
    ) {
        $this->id_tenrac = $id_tenrac;
        $this->nom = $nom;
        $this->couriel = $couriel;
        $this->tel = $tel;
        $this->adresse = $adresse;
        $this->grade = $grade;
        $this->id_club = $id_club;
        $this->id_ordre = $id_ordre;
        $this->rang = $rang;
        $this->titre = $titre;
        $this->dignite = $dignite;
    }

    public function getIdTenrac(): int {
        return $this->id_tenrac;
    }

    public function getNom(): string {
        return $this->nom;
    }

    public function getCouriel(): string {
        return $this->couriel;
    }

    public function getTel(): string {
        return $this->tel;
    }

    public function getAdresse(): string {
        return $this->adresse;
    }

    public function getGrade(): string {
        return $this->grade;
    }

    public function getIdClub(): int {
        return $this->id_club;
    }

    public function getIdOrdre(): int {
        return $this->id_ordre;
    }

    public function getRang(): ?string {
        return $this->rang;
    }

    public function getTitre(): ?string {
        return $this->titre;
    }

    public function getDignite(): ?string {
        return $this->dignite;
    }
}
?>
