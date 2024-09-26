<?php

class DateRepas
{
    private string $date_repas;

    public function __construct(string $date_repas)
    {
        $this->date_repas = $date_repas;
    }

    public function getDateRepas(): string
    {
        return $this->date_repas;
    }

    public function setDateRepas(string $date_repas): void
    {
        $this->date_repas = $date_repas;
    }

    public function __toString(): string
    {
        return "Date du repas : {$this->date_repas}";
    }
}
