<?php
require_once __DIR__ . '/modules/blog/controllers/HomePageController.php';

function loadPage($page) {
    $controller = new HomePageController();

    switch ($page) {
        case 'homepage':
            $controller->showHomePage();
            break;
        case 'login':
            $controller->showLoginPage();
            break;
        default:
            $controller->show404();
            break;
    }
}

$page = isset($_GET['page']) ? $_GET['page'] : 'homepage';

loadPage($page);

?>

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