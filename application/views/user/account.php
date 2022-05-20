<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PKP Online</title>
    <link href="<?= base_url() ?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/css/style.css" rel="stylesheet">
    <style>
        #nav2{
            margin-top: 100px;
        }
    </style>
</head>

<body>
    <header id="header" class="fixed-top">
        <div class="container d-flex align-items-center">

            <h1 class="logo me-auto"><a href="<?= base_url() ?>">PKP Online</a></h1>
            <!-- Uncomment below if you prefer to use an image logo -->
            <!-- <a href="index.html" class="logo me-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

            <nav id="navbar" class="navbar order-last order-lg-0">
                <ul>
                    <li><a class="nav-link" href="<?= base_url() ?>">Home</a></li>
                    <li><a class="nav-link" href="<?= base_url() ?>search">Wyszukaj połączenie kolejowe</a></li>
                    <li><a class="nav-link" href="<?= base_url() ?>ticket/buy">Kup bilet</a></li>
                    <li><a class="nav-link scrollto" href="<?= base_url() ?>#contact">Kontakt</a></li>
                    <li class="dropdown"><a href="#" class="active"><span>Strefa pasażera</span> <i
                                class="bi bi-chevron-down"></i></a>
                        <ul>
                            <?php
                              if($this->session->loggedIn){
                            ?>
                            <li><a href="<?= base_url() ?>user/account">Moje konto</a></li>
                            <li><a href="<?= base_url() ?>user/logout">Wyloguj</a></li>
                            <?php
                            }
                            else{
                              ?>
                            <li><a href="<?= base_url() ?>user/login">Logowanie</a></li>
                            <li><a href="<?= base_url() ?>user/register">Rejestracja</a></li>
                            <?php } ?>
                        </ul>
                    </li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav>
        </div>
    </header>
    <div class="container">
    <nav id="nav2">
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Twoje dane</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url() ?>ticket/myTickets">Historia biletów</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url() ?>user/settings">Ustawienia</a>
        </li>
    </ul>
    </nav>
    </div>
    

    

    <footer>

        <div class="container d-md-flex py-4">

            <div class="me-md-auto text-center text-md-start">
                <div class="copyright">
                    &copy; Copyright <strong><span>PKP Online</span></strong>. Wszelkie prawa zastrzeżone
                </div>
            </div>
        </div>
    </footer>
</body>
<script src="<?= base_url() ?>assets/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url() ?>assets/js/main.js"></script>

</html>