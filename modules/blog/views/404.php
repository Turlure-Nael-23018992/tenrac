<?php
    class ErrorPage {
        public function show(): void {
            ?>
            <html>
            <head>
                <link rel="stylesheet" type="text/css" href="/_assets/styles/404.css">
                <link rel="stylesheet" type="text/css" href="/_assets/styles/styles.css">
            </head>
            <body>
                <h1>404</h1>
                <a href="/?page=homepage" class="logo"></a>
            </body>
            </html>
            <?php
        }
    }




