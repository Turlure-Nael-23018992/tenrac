<?php

/**
 * Classe AlimentDesPlats
 *
 * Représente une relation entre un plat et un aliment, avec leurs identifiants respectifs.
 */
class AlimentDesPlats
{
    /**
     * @var int $id_plat L'ID du plat.
     */
    private int $id_plat;

    /**
     * @var int $id_aliment L'ID de l'aliment.
     */
    private int $id_aliment;

    /**
     * Constructeur de la classe AlimentDesPlats.
     *
     * @param int $id_plat L'ID du plat.
     * @param int $id_aliment L'ID de l'aliment.
     */
    public function __construct(int $id_plat, int $id_aliment)
    {
        $this->id_plat = $id_plat;
        $this->id_aliment = $id_aliment;
    }

    /**
     * Obtenir l'ID du plat.
     *
     * @return int Retourne l'ID du plat.
     */
    public function getIdPlat(): int
    {
        return $this->id_plat;
    }

    /**
     * Obtenir l'ID de l'aliment.
     *
     * @return int Retourne l'ID de l'aliment.
     */
    public function getIdAliment(): int
    {
        return $this->id_aliment;
    }

    /**
     * Définir un nouvel ID pour le plat.
     *
     * @param int $id_plat L'ID du plat à définir.
     * @return void
     */
    public function setIdPlat(int $id_plat): void
    {
        $this->id_plat = $id_plat;
    }

    /**
     * Définir un nouvel ID pour l'aliment.
     *
     * @param int $id_aliment L'ID de l'aliment à définir.
     * @return void
     */
    public function setIdAliment(int $id_aliment): void
    {
        $this->id_aliment = $id_aliment;
    }

    /**
     * Convertit l'instance d'AlimentDesPlats en chaîne de caractères pour un affichage facile.
     *
     * @return string Retourne une représentation textuelle de l'ID du plat et de l'aliment.
     */
    public function __toString(): string
    {
        return "Plat ID: {$this->id_plat}, Aliment ID: {$this->id_aliment}";
    }
}
?>
