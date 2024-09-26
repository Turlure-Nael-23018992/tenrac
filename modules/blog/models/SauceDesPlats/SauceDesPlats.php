<?php

class SauceDesPlat
{
    private int $id_plat;
    private int $id_sauce;

    public function __construct(int $id_plat, int $id_sauce)
    {
        $this->id_plat = $id_plat;
        $this->id_sauce = $id_sauce;
    }

    public function getIdPlat(): int
    {
        return $this->id_plat;
    }

    public function getIdSauce(): int
    {
        return $this->id_sauce;
    }

    public function setIdPlat(int $id_plat): void
    {
        $this->id_plat = $id_plat;
    }

    public function setIdSauce(int $id_sauce): void
    {
        $this->id_sauce = $id_sauce;
    }

    public function __toString(): string
    {
        return "Plat ID: {$this->id_plat}, Sauce ID: {$this->id_sauce}";
    }
}
