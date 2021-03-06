<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PKP Online :: <?= $page_title ?></title>
    <link href="<?= base_url() ?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/css/style.css" rel="stylesheet">
</head>

<body>
    <header id="header" class="fixed-top">
        <div class="container d-flex align-items-center">

            <h1 class="logo me-auto"><a href="<?= base_url() ?>">PKP Online</a></h1>
            <!-- <a href="index.html" class="logo me-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

            <nav id="navbar" class="navbar order-last order-lg-0">
                <ul>
                    <li><a class="nav-link <?= $nav_item == "home" ? "active":"" ?>" href="<?= base_url() ?>">Home</a></li>
                    <li><a class="nav-link <?= $nav_item == "search" ? "active":"" ?>" href="<?= base_url() ?>search">Wyszukaj połączenie kolejowe</a></li>
                    <li><a class="nav-link <?= $nav_item == "ticket" ? "active":"" ?>" href="<?= base_url() ?>search">Kup bilet</a></li>
                    <li><a class="nav-link" href="<?= base_url() ?>#contact">Kontakt</a></li>
                    <?php if($this->session->user_type_id == 1 || $this->session->user_type_id == 2){
                        echo '<li><a class="nav-link ';
                        echo $nav_item == "admin" ? "active":"";
                        echo '" href="'. base_url() .'admin">Panel admina</a></li>';
                    }
                    ?>
                    <li class="dropdown"><a href="#" class="<?= $nav_item == "account" ? "active":"" ?>"><span>Strefa pasażera</span> <i class="bi bi-chevron-down"></i></a>
                        <ul>
                            <?php
                              if($this->session->loggedIn){
                            ?>
                            <li><a href="<?= base_url() ?>user/account">Moje konto</a></li>
                            <li><a href="<?= base_url() ?>user/settings">Ustawienia</a></li>
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