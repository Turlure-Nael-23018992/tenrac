<?php
require_once 'modules/blog/models/Sauce/Sauce.php';

class SauceDAO
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getSauceById(int $id_sauce): ?Sauce
    {
        $query = "SELECT id_sauce, nom FROM Sauce WHERE id_sauce = :id_sauce";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id_sauce', $id_sauce, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            return new Sauce($result['id_sauce'], $result['nom']);
        }

        return null;
    }
}
