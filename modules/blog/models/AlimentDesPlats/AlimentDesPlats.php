<?php

class AlimentDesPlats
{
    private int $id_plat;
    private int $id_aliment;

    public function __construct(int $id_plat, int $id_aliment)
    {
        $this->id_plat = $id_plat;
        $this->id_aliment = $id_aliment;
    }

    public function getIdPlat(): int
    {
        return $this->id_plat;
    }

    public function getIdAliment(): int
    {
        return $this->id_aliment;
    }

    public function setIdPlat(int $id_plat): void
    {
        $this->id_plat = $id_plat;
    }

    public function setIdAliment(int $id_aliment): void
    {
        $this->id_aliment = $id_aliment;
    }

    public function __toString(): string
    {
        return "Plat ID: {$this->id_plat}, Aliment ID: {$this->id_aliment}";
    }
}
