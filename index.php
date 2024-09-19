<?php
require '_assets/includes/autoloader.php';
try {
    if (filter_input(INPUT_GET, 'action')) {
        switch($_GET['action']) {
            case 'homepage':
                (new \Blog\Controllers\HomePageController\HomePageController())->execute();
                break;
            case 'struture':
                (new \Blog\Controllers\StructureController\StructureController())->execute();
                break;
            default:
                throw new ControllerException('La page que vous recherchez n\'existe pas');
        }
        
    }
    (new \Blog\Controllers\HomePageController\Homepage())->execute();
} catch (ControllerException $e) {
    (new \Blog\Views\Error($e->getMessage()))->show();
}
?>

<?php
$servername = "mysql-tenrac-projet.alwaysdata.net"; 
$username = "374958_admin2"; 
$password = "tenracprojetmdp";
$dbname = "tenrac-projet_valentin";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connexion réussie !";
} catch (PDOException $e) {
    echo "Échec de la connexion : " . $e->getMessage();
}
$conn = null;
?>