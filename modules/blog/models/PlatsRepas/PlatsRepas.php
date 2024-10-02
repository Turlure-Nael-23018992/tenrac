<?php

/**
 * Classe PlatsRepas
 *
 * Représente une association entre un plat et un repas.
 */
class PlatsRepas
{
    private int $id_plat; // Identifiant du plat
    private int $id_repas; // Identifiant du repas

    /**
     * Constructeur de la classe PlatsRepas.
     *
     * @param int $id_plat L'ID du plat.
     * @param int $id_repas L'ID du repas.
     */
    public function __construct(int $id_plat, int $id_repas)
    {
        $this->id_plat = $id_plat;
        $this->id_repas = $id_repas;
    }

    /**
     * Récupère l'identifiant du plat.
     *
     * @return int L'ID du plat.
     */
    public function getIdPlat(): int
    {
        return $this->id_plat;
    }

    /**
     * Récupère l'identifiant du repas.
     *
     * @return int L'ID du repas.
     */
    public function getIdRepas(): int
    {
        return $this->id_repas;
    }

    /**
     * Définit l'identifiant du plat.
     *
     * @param int $id_plat L'ID du plat à définir.
     * @return void
     */
    public function setIdPlat(int $id_plat): void
    {
        $this->id_plat = $id_plat;
    }

    /**
     * Définit l'identifiant du repas.
     *
     * @param int $id_repas L'ID du repas à définir.
     * @return void
     */
    public function setIdRepas(int $id_repas): void
    {
        $this->id_repas = $id_repas;
    }

    /**
     * Retourne une représentation sous forme de chaîne de l'association plat-repas.
     *
     * @return string Représentation sous forme de chaîne de l'association.
     */
    public function __toString(): string
    {
        return "Plat ID: {$this->id_plat}, Repas ID: {$this->id_repas}";
    }
}
?>
