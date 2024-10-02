<?php

/**
 * Classe SauceDesPlat
 *
 * Représente l'association entre un plat et une sauce.
 */
class SauceDesPlat
{
    private int $id_plat;  // Identifiant du plat
    private int $id_sauce; // Identifiant de la sauce

    /**
     * Constructeur de la classe SauceDesPlat.
     *
     * @param int $id_plat L'ID du plat.
     * @param int $id_sauce L'ID de la sauce.
     */
    public function __construct(int $id_plat, int $id_sauce)
    {
        $this->id_plat = $id_plat;
        $this->id_sauce = $id_sauce;
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
     * Récupère l'identifiant de la sauce.
     *
     * @return int L'ID de la sauce.
     */
    public function getIdSauce(): int
    {
        return $this->id_sauce;
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
     * Définit l'identifiant de la sauce.
     *
     * @param int $id_sauce L'ID de la sauce à définir.
     * @return void
     */
    public function setIdSauce(int $id_sauce): void
    {
        $this->id_sauce = $id_sauce;
    }

    /**
     * Retourne une représentation sous forme de chaîne de l'association plat-sauce.
     *
     * @return string Représentation sous forme de chaîne de l'association.
     */
    public function __toString(): string
    {
        return "Plat ID: {$this->id_plat}, Sauce ID: {$this->id_sauce}";
    }
}
?>
