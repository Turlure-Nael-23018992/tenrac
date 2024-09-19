<?php

namespace Blog\Models\HomePageRepository;

use Includes\Database\DatabaseConnection;

class HomePageRepository {
    public function __construct(private DatabaseConnection $connection) {}

    public function getRepas(): array {
        if (!$statement = $this->connection->getConnection()->query('SELECT * FROM meals')) {
            throw new DatabaseException('Wrong query');
        }

        $repas = [];
        while ($row = $statement->fetch(\PDO::FETCH_OBJ)) {
            $repas[] = new Post($row->id, $row->title, $row->creation_date, $row->content);
        }

        return $repas;
    }
}
