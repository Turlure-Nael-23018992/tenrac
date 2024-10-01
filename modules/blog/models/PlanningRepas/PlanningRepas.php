<?php

/**
 * Class PlanningRepas
 *
 * Cette classe représente la planification d'un repas.
 * Elle contient des informations telles que l'adresse,
 * la date, l'identifiant du repas et l'horaire.
 */
class PlanningRepas
{
    /**
     * @var string $adresse L'adresse où le repas est prévu.
     */
    private string $adresse;

    /**
     * @var string $date_repas La date du repas au format 'yyyy-mm-dd'.
     */
    private string $date_repas;

    /**
     * @var int $id_repas L'identifiant du repas.
     */
    private int $id_repas;

    /**
     * @var float $horaire L'heure à laquelle le repas est prévu (format décimal).
     */
    private float $horaire;

    /**
     * PlanningRepas constructor.
     *
     * @param string $adresse   L'adresse où le repas est prévu.
     * @param string $date_repas La date du repas au format 'yyyy-mm-dd'.
     * @param int $id_repas      L'identifiant du repas.
     * @param float $horaire     L'heure à laquelle le repas est prévu.
     */
    public function __construct(string $adresse, string $date_repas, int $id_repas, float $horaire)
    {
        $this->adresse = $adresse;
        $this->date_repas = $date_repas;
        $this->id_repas = $id_repas;
        $this->horaire = $horaire;
    }

    /**
     * Récupère l'adresse du repas.
     *
     * @return string L'adresse du repas.
     */
    public function getAdresse(): string
    {
        return $this->adresse;
    }

    /**
     * Récupère la date du repas.
     *
     * @return string La date du repas au format 'yyyy-mm-dd'.
     */
    public function getDateRepas(): string
    {
        return $this->date_repas;
    }

    /**
     * Récupère l'identifiant du repas.
     *
     * @return int L'identifiant du repas.
     */
    public function getIdRepas(): int
    {
        return $this->id_repas;
    }

    /**
     * Récupère l'horaire du repas.
     *
     * @return float L'horaire du repas (format décimal).
     */
    public function getHoraire(): float
    {
        return $this->horaire;
    }

    /**
     * Définit l'adresse du repas.
     *
     * @param string $adresse L'adresse à définir.
     */
    public function setAdresse(string $adresse): void
    {
        $this->adresse = $adresse;
    }

    /**
     * Définit la date du repas.
     *
     * @param string $date_repas La date à définir au format 'yyyy-mm-dd'.
     */
    public function setDateRepas(string $date_repas): void
    {
        $this->date_repas = $date_repas;
    }

    /**
     * Définit l'identifiant du repas.
     *
     * @param int $id_repas L'identifiant à définir.
     */
    public function setIdRepas(int $id_repas): void
    {
        $this->id_repas = $id_repas;
    }

    /**
     * Définit l'horaire du repas.
     *
     * @param float $horaire L'horaire à définir (format décimal).
     */
    public function setHoraire(float $horaire): void
    {
        $this->horaire = $horaire;
    }

    /**
     * Retourne une représentation sous forme de chaîne de caractères de l'objet.
     *
     * @return string Une chaîne contenant les détails du repas.
     */
    public function __toString(): string
    {
        return "Adresse: {$this->adresse}, Date: {$this->date_repas}, Repas ID: {$this->id_repas}, Horaire: {$this->horaire}";
    }
}
