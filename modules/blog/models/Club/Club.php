<?php

/**
 * Classe Club
 * 
 * Représente un club avec un identifiant, un nom, et un ordre par défaut de 1.
 */
class Club
{
    /**
     * @var int $id_club L'ID unique du club.
     */
    private int $id_club;

    /**
     * @var string $nom Le nom du club.
     */
    private string $nom;

    /**
     * @var int $id_ordre Le champ id_ordre, par défaut à 1.
     */
    private int $id_ordre = 1;

    /**
     * Constructeur de la classe Club.
     * 
     * @param int $id_club L'ID unique du club.
     * @param string $nom Le nom du club.
     * @param int $id_ordre L'ordre du club, par défaut 1.
     */
    public function __construct(int $id_club, string $nom, int $id_ordre = 1)
    {
        $this->id_club = $id_club;
        $this->nom = $nom;
        $this->id_ordre = $id_ordre;
    }

    /**
     * Obtenir l'ID du club.
     * 
     * @return int Retourne l'ID du club.
     */
    public function getIdClub(): int
    {
        return $this->id_club;
    }

    /**
     * Obtenir le nom du club.
     * 
     * @return string Retourne le nom du club.
     */
    public function getNom(): string
    {
        return $this->nom;
    }

    /**
     * Obtenir l'ordre du club.
     * 
     * @return int Retourne l'ID de l'ordre (toujours 1 par défaut).
     */
    public function getIdOrdre(): int
    {
        return $this->id_ordre;
    }

    /**
     * Modifier l'ID du club.
     * 
     * @param int $id_club L'ID du club à définir.
     * @return void
     */
    public function setIdClub(int $id_club): void
    {
        $this->id_club = $id_club;
    }

    /**
     * Modifier le nom du club.
     * 
     * @param string $nom Le nouveau nom du club.
     * @return void
     */
    public function setNom(string $nom): void
    {
        $this->nom = $nom;
    }

    /**
     * Modifier l'ID de l'ordre (peu utilisé car l'ordre est par défaut à 1).
     * 
     * @param int $id_ordre Le nouvel ID de l'ordre.
     * @return void
     */
    public function setIdOrdre(int $id_ordre): void
    {
        $this->id_ordre = $id_ordre;
    }
}
?>
