<?php
class Tenrac {
    private int $id_tenrac;
    private string $courriel;
    private string $tel;
    private string $grade;
    private string $rang;
    private string $titre;
    private string $dignite;
    private string $nom;
    private string $adresse;
    private string $motdepasse;
    private int $id_club;
    private int $id_ordre;

    public function __construct($id_tenrac, $courriel, $tel, $grade, $rang, $titre, $dignite, $nom, $adresse, $motdepasse, $id_club, $id_ordre) {
        $this->id_tenrac = $id_tenrac;
        $this->courriel = $courriel;
        $this->tel = $tel;
        $this->grade = $grade;
        $this->rang = $rang;
        $this->titre = $titre;
        $this->dignite = $dignite;
        $this->nom = $nom;
        $this->adresse = $adresse;
        $this->motdepasse = $motdepasse;
        $this->id_club = $id_club;
        $this->id_ordre = $id_ordre;
    }

    public function getIdTenrac(): int {
        return $this->id_tenrac;
    }

    public function getCourriel(): string {
        return $this->courriel;
    }

    public function getTel(): string {
        return $this->tel;
    }

    public function getGrade(): string {
        return $this->grade;
    }

    public function getRang(): string {
        return $this->rang;
    }

    public function getTitre(): string {
        return $this->titre;
    }

    public function getDignite(): string {
        return $this->dignite;
    }

    public function getNom(): string {
        return $this->nom;
    }

    public function getAdresse(): string {
        return $this->adresse;
    }

    public function getMotdepasse(): string {
        return $this->motdepasse;
    }

    public function getIdClub(): int {
        return $this->id_club;
    }

    public function getIdOrdre(): int {
        return $this->id_ordre;
    }

    public function setIdTenrac(int $id_tenrac): void {
        $this->id_tenrac = $id_tenrac;
    }

    public function setCourriel(string $courriel): void {
        $this->courriel = $courriel;
    }

    public function setTel(string $tel): void {
        $this->tel = $tel;
    }

    public function setGrade(string $grade): void {
        $this->grade = $grade;
    }

    public function setRang(string $rang): void {
        $this->rang = $rang;
    }

    public function setTitre(string $titre): void {
        $this->titre = $titre;
    }

    public function setDignite(string $dignite): void {
        $this->dignite = $dignite;
    }

    public function setNom(string $nom): void {
        $this->nom = $nom;
    }

    public function setAdresse(string $adresse): void {
        $this->adresse = $adresse;
    }

    public function setMotdepasse(string $motdepasse): void {
        $this->motdepasse = $motdepasse;
    }

    public function setIdClub(int $id_club): void {
        $this->id_club = $id_club;
    }

    public function setIdOrdre(int $id_ordre): void {
        $this->id_ordre = $id_ordre;
    }

    public function __toString(): string {
        return "Tenrac: {ID: $this->id_tenrac, Courriel: $this->courriel, Tel: $this->tel, Grade: $this->grade, Rang: $this->rang, Titre: $this->titre, Dignité: $this->dignite, Nom: $this->nom, Adresse: $this->adresse, Mot de passe: $this->motdepasse, ID Club: $this->id_club, ID Ordre: $this->id_ordre}";
    }
}
?>
