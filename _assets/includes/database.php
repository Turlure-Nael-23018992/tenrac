<?php

$servername = "mysql-tenrac-projet.alwaysdata.net"; 
$username = "374958_admin2"; 
$password = "tenracprojetmdp";
$dbname = "tenrac-projet_valentin";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Échec de connexion à la base de données : " . $e->getMessage();
    exit;
}

?>