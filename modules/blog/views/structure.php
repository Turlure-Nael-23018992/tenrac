<?php
class Structure{
    private $clubs;
    public function __construct($c){
        $this->clubs = $c;
    }

    public function show():void{
?>
<head>
    <link rel="stylesheet" type="text/css" href="/_assets/styles/structure.css">
    <link rel="stylesheet" type="text/css" href="/_assets/styles/styles.css">
</head>
<?php include 'header.php'; ?>
<main>
    <div class="cont-h1">
        <h1>
        <table>
        <tr>
            <th>ID Club</th>
            <th>Nom</th>
            <th>ID Ordre</th>
        </tr>
        <?php
        foreach ($this->clubs as $club) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($club->getIdClub()) . "</td>";
            echo "<td>" . htmlspecialchars($club->getNom()) . "</td>";
            echo "<td>" . "Ordre des tenrac" . "</td>";
            echo "</tr>";
        }
        ?>
        </h1>
    </div>
    

</main>
<script src="/_assets/scripts/homepage.js"></script>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
<?php
    }
}
?>