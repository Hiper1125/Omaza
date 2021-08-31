<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/home.css">
    <link rel="stylesheet" type="text/css" href="css/anim.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/9565958271.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="js/core.js"></script>
    <script src="js/transition.js"></script>
    <link rel="icon" href='img/favicon.png'>
    <title>Home — Omaza</title>
</head>

<body class="animate-in" onload="Setup()">
    <div class="Navigations">

        <nav class="Main-nav">
            <div class="other">
                <img class="logo" src="img/omaza_logo_white.svg">
                <div class="box"><a>
                        <p class="text-darker">Invia a</p>
                        <p id="city">Città</p>
                    </a>
                </div>
            </div>
            <div class="Search">
                <button class="src-category">Tutte le categorie<img class="arrow" src="img/arrow.svg"></button>
                <input class="src-input" name="user-query" id="user-query" type="text">
                <button class="src-btn" onclick="Search()"><img src="img/search.svg"></button>
            </div>

            <div class="other">
                <div class="box"><a onclick="Login()">
                        <p class="text-darker" id="welcome">Non sei loggato</p>
                        <p id="username">Accedi/registrati</p>
                    </a></div>
                <div class="box"><a>
                        <p class="text-darker">Resi e</p>
                        <p>Ordini</p>
                    </a></div>
                <div class="box"><a>
                        <p><img src="img/cart.svg">Carrello</p>
                    </a></div>
            </div>
        </nav>

        <nav class="Filter-nav">
            <div class="Filters-menu">
                <a>
                    <h2><img class="icon" src="img/menu.svg">Tutte</h2>
                </a>
            </div>

            <div class="Filters-menu">
                <a>
                    <h2>Acquista di nuovo</h2>
                </a>

                <a>
                    <h2>Offerte</h2>
                </a>

                <a>
                    <h2>Libri</h2>
                </a>

                <a>
                    <h2>Elettronica</h2>
                </a>

                <a>
                    <h2>Informatica</h2>
                </a>

                <a onclick="Logout()">
                    <h2>Esci</h2>
                </a>
            </div>
        </nav>
    </div>

    <div class="Products">
        <div class="container">
            <div class="row">
                <?php

                include('php/search.php');

                if (isset($_GET['Name'])) {
                    $Name = $_GET['Name'];

                    $Rows = SearchProductBy($Name);
                }
                else
                {
                    $Rows = SearchProductIn();
                }

                PrintProductsBy($Rows);

                ?>
            </div>
        </div>
    </div>

</body>

</html>