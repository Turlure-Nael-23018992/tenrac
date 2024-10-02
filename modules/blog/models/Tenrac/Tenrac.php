<?php

class Tenrac
{
    private int $id_tenrac;        // Identifiant unique du tenrac
    private string $nom;           // Nom du tenrac
    private string $couriel;       // Courriel du tenrac
    private string $tel;           // Numéro de téléphone du tenrac
    private string $adresse;       // Adresse du tenrac
    private string $grade;         // Grade du tenrac
    private ?int $id_club;          // Identifiant du club associé
    private int $id_ordre;         // Identifiant de l'ordre associé
    private ?string $rang;         // Rang du tenrac (facultatif)
    private ?string $titre;        // Titre du tenrac (facultatif)
    private ?string $dignite;      // Dignité du tenrac (facultatif)

    /**
     * Constructeur de la classe Tenrac.
     *
     * @param int $id_tenrac Identifiant unique du tenrac.
     * @param string $nom Nom du tenrac.
     * @param string $couriel Courriel du tenrac.
     * @param string $tel Numéro de téléphone du tenrac.
     * @param string $adresse Adresse du tenrac.
     * @param string $grade Grade du tenrac.
     * @param int $id_club Identifiant du club associé.
     * @param int $id_ordre Identifiant de l'ordre associé.
     * @param string|null $rang Rang du tenrac (facultatif).
     * @param string|null $titre Titre du tenrac (facultatif).
     * @param string|null $dignite Dignité du tenrac (facultatif).
     */
    public function __construct(
        int $id_tenrac,
        string $nom,
        string $couriel,
        string $tel,
        string $adresse,
        string $grade,
        ?int $id_club,
        int $id_ordre,
        ?string $rang = null,
        ?string $titre = null,
        ?string $dignite = null
    ) {
        $this->id_tenrac = $id_tenrac; // Initialise l'ID du tenrac
        $this->nom = $nom;               // Initialise le nom du tenrac
        $this->couriel = $couriel;       // Initialise le courriel du tenrac
        $this->tel = $tel;               // Initialise le numéro de téléphone du tenrac
        $this->adresse = $adresse;       // Initialise l'adresse du tenrac
        $this->grade = $grade;           // Initialise le grade du tenrac
        $this->id_club = $id_club;       // Initialise l'ID du club
        $this->id_ordre = $id_ordre;     // Initialise l'ID de l'ordre
        $this->rang = $rang;             // Initialise le rang (facultatif)
        $this->titre = $titre;           // Initialise le titre (facultatif)
        $this->dignite = $dignite;       // Initialise la dignité (facultatif)
    }

    /**
     * Récupère l'ID du tenrac.
     *
     * @return int L'ID du tenrac.
     */
    public function getIdTenrac(): int {
        return $this->id_tenrac;
    }

    /**
     * Récupère le nom du tenrac.
     *
     * @return string Le nom du tenrac.
     */
    public function getNom(): string {
        return $this->nom;
    }

    /**
     * Récupère le courriel du tenrac.
     *
     * @return string Le courriel du tenrac.
     */
    public function getCouriel(): string {
        return $this->couriel;
    }

    /**
     * Récupère le numéro de téléphone du tenrac.
     *
     * @return string Le numéro de téléphone du tenrac.
     */
    public function getTel(): string {
        return $this->tel;
    }

    /**
     * Récupère l'adresse du tenrac.
     *
     * @return string L'adresse du tenrac.
     */
    public function getAdresse(): string {
        return $this->adresse;
    }

    /**
     * Récupère le grade du tenrac.
     *
     * @return string Le grade du tenrac.
     */
    public function getGrade(): string {
        return $this->grade;
    }

    /**
     * Récupère l'ID du club associé au tenrac.
     *
     * @return int L'ID du club.
     */
    public function getIdClub(): ?int {
        return $this->id_club;
    }

    /**
     * Récupère l'ID de l'ordre associé au tenrac.
     *
     * @return int L'ID de l'ordre.
     */
    public function getIdOrdre(): int {
        return $this->id_ordre;
    }

    /**
     * Récupère le rang du tenrac.
     *
     * @return string|null Le rang du tenrac ou null s'il n'est pas défini.
     */
    public function getRang(): ?string {
        return $this->rang;
    }

    /**
     * Récupère le titre du tenrac.
     *
     * @return string|null Le titre du tenrac ou null s'il n'est pas défini.
     */
    public function getTitre(): ?string {
        return $this->titre;
    }

    /**
     * Récupère la dignité du tenrac.
     *
     * @return string|null La dignité du tenrac ou null s'il n'est pas défini.
     */
    public function getDignite(): ?string {
        return $this->dignite;
    }
}
?>
