<?php
$servername = "mysql-tenrac-projet.alwaysdata.net"; 
$username = "374958_admin2"; 
$password = "tenracprojetmdp";
$dbname = "tenrac-projet_valentin";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {

}
$conn = null;
?>