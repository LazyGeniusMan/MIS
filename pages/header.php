<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $pageTitle ?></title>
    <link rel="stylesheet" href="styles\bulma.min.css"> <!-- Bulma.io -->
    <style>
        nav{
            box-shadow:0 .5em 1em -.125em rgba(10,10,10,.1),0 0 0 1px rgba(10,10,10,.02);
        }
        footer {
            background-color: #f5f5f5;
            box-shadow:0 -.5em 1em -.125em rgba(10,10,10,.1),0 0 0 1px rgba(10,10,10,.02);
        }
        .unit:hover{
            cursor: default;
        }
    </style>
    <script defer src="scripts\all.js"></script> <!-- Font-Awesome -->
</head>

<body>
    <?php
    if ($_SERVER['PHP_SELF'] !== "/login.php") : ?>
        <nav class="navbar is-light">
            <div class="navbar-start">
                <div class="navbar-item">
                    <div class="buttons">
                    <a class="button is-primary" href="index.php"><i class="fa fa-home"></i>&ensp;Home</a>
                    </div>
                </div>
            </div>
            <div class="navbar-end">
                <div class="navbar-item">
                    <div class="buttons">
                        <a class="button is-danger" href="logout.php"><i class="fa fa-sign-out-alt"></i>&ensp;Logout</a>
                    </div>
                </div>
            </div>
        </nav>
    <?php endif; ?>
    <?php
        $currency = "Rp";
    ?>