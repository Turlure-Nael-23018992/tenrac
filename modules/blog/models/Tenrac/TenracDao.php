<?php
class TenracDAO {
    private $connection;

    public function __construct($connection) {
        $this->connection = $connection;
    }

    public function getTenracById(int $id_tenrac): ?Tenrac {
        $query = "SELECT * FROM Tenrac WHERE id_tenrac = :id_tenrac";
        $stmt = $this->pdo->prepare($query);
        $stmt->bind_param(':id_tenrac', $id_tenrac, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            return new Tenrac(
                $result['id_tenrac'],
                $result['courriel'],
                $result['tel'],
                $result['grade'],
                $result['rang'],
                $result['titre'],
                $result['dignite'],
                $result['nom'],
                $result['adresse'],
                $result['motdepasse'],
                $result['id_club'],
                $result['id_ordre']
            );
        }
        return null;
    }

    public function getAllTenracs(): array {
        $query = "SELECT * FROM Tenrac";
        $result = $this->connection->query($query);
        $tenracs = [];

        while ($row = $result->fetch_assoc()) {
            $tenracs[] = new Tenrac(
                $row['id_tenrac'],
                $row['courriel'],
                $row['tel'],
                $row['grade'],
                $row['rang'],
                $row['titre'],
                $row['dignite'],
                $row['nom'],
                $row['adresse'],
                $row['motdepasse'],
                $row['id_club'],
                $row['id_ordre']
            );
        }

        return $tenracs;
    }
}
?>
