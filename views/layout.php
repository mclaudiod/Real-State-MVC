<?php

    if(!isset($_SESSION)) {
        session_start();
    };

    $auth = $_SESSION["login"] ?? false;

    if(!isset($index)) {
        $index = false;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Real State</title>
    <link rel="stylesheet" href="../build/css/app.css">
</head>
<body>
    <header class="header <?php echo $index ? "start" : ""; ?>">
    <!-- (Condition) ? (Statement1) : (Statement2);
    Condition: It is the expression to be evaluated which returns a boolean value.
    Statement 1: it is the statement to be executed if the condition results in a true state.
    Statement 2: It is the statement to be executed if the condition results in a false state. -->
        <div class="container header-content">
            <div class="bar">
                <a href="/">
                    <img src="/build/img/logo.svg" alt="Real State Logo">
                </a>

                <div class="mobile-menu">
                    <img src="/build/img/barras.svg" alt="Responsive Menu Icon">
                </div>

                <div class="right">
                    <img class="dark-mode-button" src="/build/img/dark-mode.svg">

                    <nav class="navigation">
                        <a href="/about-us">About Us</a>
                        <a href="/properties">Advertisements</a>
                        <a href="/blog">Blog</a>
                        <a href="/contact">Contact</a>
                        <?php if($auth): ?>
                            <a href="/logout">Log Out</a>
                        <?php endif; ?>
                    </nav>
                </div>
            </div> <!--.bar-->

            <?php
                if($index) {
                    echo "<h1>Luxury Real Estate - Homes for Sale</h1>";
                };
            ?>
        </div>
    </header>

    <?php echo $content; ?>

    <footer class="footer section">
        <div class="container container-footer">
            <nav class="navigation">
                <a href="/about-us">About Us</a>
                <a href="/properties">Advertisements</a>
                <a href="/blog">Blog</a>
                <a href="/contact">Contact</a>
            </nav>
        </div>

        <p class="copyright">&copy; <?php echo date("Y"); ?> All Rights Reserved</p>
    </footer>

    <script src="../build/js/bundle.js"></script>
</body>
</html>