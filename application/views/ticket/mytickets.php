<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PKP Online :: Logowanie</title>
    <link href="<?= base_url() ?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/css/style.css" rel="stylesheet">
    <style>
    body,
    html {
        height: 100%;
    }

    .bg {
        background-image: url("<?= base_url() ?>assets/img/hero-bg.jpg");

        height: 100%;

        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
    }

    .center-screen {
        display: flex;
        justify-content: center;
        align-items: center;
        text-align: center;
        min-height: 100vh;
    }

    .center-screen input {
        border-radius: 0;
    }

    .center-screen button {
        background: #1977cc;
        border: 0;
        padding: 10px 35px;
        background-color: #1977cc;
        transition: 0.4s;
        border-radius: 50px;
    }
    </style>
</head>

<body>
<header id="header" class="fixed-top">
        <div class="container d-flex align-items-center">

            <h1 class="logo me-auto"><a href="index.html">PKP Online</a></h1>
            <!-- Uncomment below if you prefer to use an image logo -->
            <!-- <a href="index.html" class="logo me-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

            <nav id="navbar" class="navbar order-last order-lg-0">
                <ul>
                    <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
                    <li><a class="nav-link scrollto" href="#about">Wyszukaj połączenie kolejowe</a></li>
                    <li><a class="nav-link scrollto" href="#services">Kup bilet</a></li>
                    <li><a class="nav-link scrollto" href="#departments">Kontakt</a></li>
                    <li class="dropdown"><a href="#"><span>Strefa pasażera</span> <i class="bi bi-chevron-down"></i></a>
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
    <div class="bg">
        <div class="center-screen">
            <div class="col-xs-12 col-md-4 bg-light p-4 rounded">
                <h2>Moje bilety</h2>
                <p>PKP Online</p>
                <hr>
                <p>Historia zakupionych biletów</p>
                <table>
                        <tr>
                            <td>ID biletu	</td>
                            <td>ID user	</td>
                            <td>ID polaczenia	</td>
                            <td>ilosc	</td>
                            <td>miejsce	</td>
                            <td>przedzial</td>
                            <td>active</td>
                            <td>data zakupu</td>
                        </tr>
                        <?php foreach($records as $row){?>
                            
                        <tr>
                            <td><?php echo $row->ticket_id; ?></td>
                            <td><?php echo $row->user_id; ?></td>
                            <td><?php echo $row->connection_id; ?></td>
                            <td><?php echo $row->quantity; ?></td>
                            <td><?php echo $row->position; ?></td>
                            <td><?php echo $row->compartment; ?></td>
                            <td><?php echo $row->active; ?></td>
                            <td><?php echo $row->buytime; ?></td>
                            <td>
                                <a href="<?php echo base_url().'ticket/cancel/'.$row->ticket_id?>" class="btn btn-primary">Anuluj</a>
                            </td>
                        </tr>
                        
                        <?php }?>
                    </table>
            </div>
        </div>
    </div>
</body>
<script src="<?= base_url() ?>assets/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url() ?>assets/js/main.js"></script>
<script>

</html>