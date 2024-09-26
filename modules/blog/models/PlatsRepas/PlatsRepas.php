<?php

class PlatsRepas
{
    private int $id_plat;
    private int $id_repas;

    public function __construct(int $id_plat, int $id_repas)
    {
        $this->id_plat = $id_plat;
        $this->id_repas = $id_repas;
    }

    public function getIdPlat(): int
    {
        return $this->id_plat;
    }

    public function getIdRepas(): int
    {
        return $this->id_repas;
    }

    public function setIdPlat(int $id_plat): void
    {
        $this->id_plat = $id_plat;
    }

    public function setIdRepas(int $id_repas): void
    {
        $this->id_repas = $id_repas;
    }

    public function __toString(): string
    {
        return "Plat ID: {$this->id_plat}, Repas ID: {$this->id_repas}";
    }
}
