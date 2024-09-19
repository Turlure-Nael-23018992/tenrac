<?php
require '_assets/includes/autoloader.php';

try {
    // Check if an 'action' parameter exists in the URL
    $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);

    if ($action) {
        switch ($action) {
            case 'homepage':
                (new \modules\blog\controllers\HomePageController\HomePageController())->execute();
                break;

            case 'structure':
                (new \modules\blog\controllers\StructureController\StructureController())->execute();
                break;

            default:
                throw new ControllerException('La page que vous recherchez n\'existe pas.');
        }
    } else {
        (new \modules\blog\controllers\HomePageController\HomePageController())->execute();
    }

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