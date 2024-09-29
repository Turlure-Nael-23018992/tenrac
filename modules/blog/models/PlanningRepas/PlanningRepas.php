<?php

class PlanningRepas
{
    private string $adresse;
    private string $date_repas; // Format yyyy-mm-jj
    private int $id_repas;
    private float $horaire; // Format décimal 4,2 (ex: 12.30 pour 12h30)

    public function __construct(string $adresse, string $date_repas, int $id_repas, float $horaire)
    {
        $this->adresse = $adresse;
        $this->date_repas = $date_repas;
        $this->id_repas = $id_repas;
        $this->horaire = $horaire;
    }

    public function getAdresse(): string
    {
        return $this->adresse;
    }

    public function getDateRepas(): string
    {
        return $this->date_repas;
    }

    public function getIdRepas(): int
    {
        return $this->id_repas;
    }

    public function getHoraire(): float
    {
        return $this->horaire;
    }

    public function setAdresse(string $adresse): void
    {
        $this->adresse = $adresse;
    }

    public function setDateRepas(string $date_repas): void
    {
        $this->date_repas = $date_repas;
    }

    public function setIdRepas(int $id_repas): void
    {
        $this->id_repas = $id_repas;
    }

    public function setHoraire(float $horaire): void
    {
        $this->horaire = $horaire;
    }

    public function __toString(): string
    {
        return "Adresse: {$this->adresse}, Date: {$this->date_repas}, Repas ID: {$this->id_repas}, Horaire: {$this->horaire}";
    }
}
?>
