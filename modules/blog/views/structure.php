<?php
    namespace modules\blog\views\structure;
    Class Structure{
        public function show() {
            ob_start();
?>
<?php
include 'header.php';
?>
<head>
    <link rel="stylesheet" type="text/css" href="/_assets/styles/structure.css">
    <link rel="stylesheet" type="text/css" href="/_assets/styles/styles.css">
</head>
<main>
    <div class="cont-h1">
        <h1>
            Les Structures
        </h1>
    </div>
    

</main>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>