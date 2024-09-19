<?php

namespace Blog\Models\HomePageRepository;

class HomePageRepository {

    public function __construct(private \Includes\Database\DatabaseConnection $connection) {}

    public function getRepas(): array
    {
        $query = 'SELECT id_repas, nom FROM Repas';
        if (!$statement = $this->connection->getConnection()->query($query)) {
            throw new DatabaseException('Wrong query');
        }

        $repasList = [];
        while ($row = $statement->fetch(PDO::FETCH_OBJ)) {
            $repas = new Repas($row->id_repas, $row->nom);
            $repasList[] = $repas;
        }

        return $repasList;
    }

    public function getRepasPlat(): array
    {
        $query = 'SELECT id_plat, id_repas FROM Plats_repas';
        if (!$statement = $this->connection->getConnection()->query($query)) {
            throw new DatabaseException('Wrong query');
        }

        $plats = [];
        while ($row = $statement->fetch(PDO::FETCH_OBJ)) {
            $plats = new Repas($row->id_plat, $row->id_repas);
            $platsList[] = $plats;
        }
        return $plats;
    }

    public function getPlat(): array
    {
        $query = 'SELECT id_plat FROM Plat';
        if (!$statement = $this->connection->getConnection()->query($query)) {
            throw new DatabaseException('Wrong query');
        }

        $plats = [];
        while ($row = $statement->fetch(PDO::FETCH_OBJ)) {
            $plats = new Repas($row->id_plat);
            $platsList[] = $plats;
        }

        return $plats;
    }

    public function getSauce():array
    {
        $query = 'SELECT id_sauce, nom FROM Sauce';
        if (!$statement = $this->connection->getConnection()->query($query)) {
            throw new DatabaseException('Wrong query');
        }

        $sauce = [];
        while ($row = $statement->fetch(PDO::FETCH_OBJ)) {
            $sauce = new Repas($row->id_sauce, $row->nom);
            $sauceList[] = $sauce;
        }
        return $repas;
        }

    
    
}