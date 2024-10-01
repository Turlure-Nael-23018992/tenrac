<?php

/**
 * Classe DateRepas
 *
 * Représente une date de repas.
 */
class DateRepas
{
    /**
     * @var string $date_repas La date du repas.
     */
    private string $date_repas;

    /**
     * Constructeur de la classe DateRepas.
     *
     * @param string $date_repas La date du repas.
     */
    public function __construct(string $date_repas)
    {
        $this->date_repas = $date_repas;
    }

    /**
     * Obtenir la date du repas.
     *
     * @return string Retourne la date du repas.
     */
    public function getDateRepas(): string
    {
        return $this->date_repas;
    }

    /**
     * Définir une nouvelle date pour le repas.
     *
     * @param string $date_repas La nouvelle date du repas.
     * @return void
     */
    public function setDateRepas(string $date_repas): void
    {
        $this->date_repas = $date_repas;
    }

    /**
     * Conversion en chaîne pour un affichage facile.
     *
     * @return string Représentation de l'objet sous forme de chaîne.
     */
    public function __toString(): string
    {
        return "Date du repas : {$this->date_repas}";
    }
}
?>
