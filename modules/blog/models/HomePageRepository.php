<?php

namespace Blog\Models\HomePageRepository;

class HomePageRepository {

    public function __construct(private \Includes\Database\DatabaseConnection $connection) {}


    public function getRepas(): array
    {
        if (!$statement = $this->connection->getConnection()->query('SELECT id, title,
        content, creation_date FROM posts ORDER BY creation_date DESC LIMIT 0, 5'))
        {
        throw new DatabaseException('Wrong query');
        }
        $repas = [];
        while ($row = $statement->fetch(PDO::FETCH_OBJ)) {
        $repas = new Post($row->id, $row->title, $row->creation_date, $row->content);
        $repas[] = $repas;
        }
        return $repas;
    }
}