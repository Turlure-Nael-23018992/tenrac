<?php

class Lieux
{
    private string $adresse;

    public function __construct(string $adresse)
    {
        $this->adresse = $adresse;
    }

    public function getAdresse(): string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): void
    {
        $this->adresse = $adresse;
    }

    public function __toString(): string
    {
        return "Adresse: {$this->adresse}";
    }
}
