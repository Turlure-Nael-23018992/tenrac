<?php

class AdressePartenaire
{
    private int $id_ordre;
    private string $adresse;

    public function __construct(int $id_ordre, string $adresse)
    {
        $this->id_ordre = $id_ordre;
        $this->adresse = $adresse;
    }

    public function getIdOrdre(): int
    {
        return $this->id_ordre;
    }

    public function getAdresse(): string
    {
        return $this->adresse;
    }

    public function setIdOrdre(int $id_ordre): void
    {
        $this->id_ordre = $id_ordre;
    }

    public function setAdresse(string $adresse): void
    {
        $this->adresse = $adresse;
    }

    public function __toString(): string
    {
        return "Adresse ID Ordre: {$this->id_ordre}, Adresse: {$this->adresse}";
    }
}
