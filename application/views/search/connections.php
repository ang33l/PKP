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
    #nav2 {
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
        <nav id="nav2"
            style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
            aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Strefa pasażera</a></li>
                <li class="breadcrumb-item active" aria-current="page">Moje konto</li>
            </ol>
        </nav>
        <nav>
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Twoje dane</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url() ?>ticket/myTickets">Historia biletów</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url() ?>user/settings">Edytuj trasy</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url() ?>user/settings">Ustawienia</a>
                </li>
            </ul>
        </nav>
        <section>
            <div class="container">
                <div class="col-md-6">
                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                <td>Imię</td>
                                <td><?= $user_data->first_name ?></td>
                            </tr>
                            <tr>
                                <td>Nazwisko</td>
                                <td><?= $user_data->last_name ?></td>
                            </tr>
                            <tr>
                                <td>Login</td>
                                <td><?= $user_data->user_name ?></td>
                            </tr>
                            <tr>
                                <td>Adres e-mail</td>
                                <td><?= $user_data->email ?></td>
                            </tr>
                            <tr>
                                <td>Typ</td>
                                <td><?= $user_data->name ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-6">

                </div>
            </div>
        </section>
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