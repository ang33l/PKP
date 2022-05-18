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
    <div class="bg">
        <div class="center-screen">
            <div class="col-xs-12 col-md-4 bg-light p-4 rounded">
                <h2>Kup bilet</h2>
                <p>PKP Online</p>
                <hr>
                <p>Kupno biletu na trasie [skąd] - [dokąd]</p>
                <form action="<?= base_url() ?>ticket/summary" method="post"> 
                <!-- <form action=""> -->
                    <div class="mb-3">
                        <label for="NumberOfSeats" class="form-label">Ilość miejsc</label>
                        <input name="numSeats" type="number" class="form-control formVal" id="NumberOfSeats" required min="0">
                    </div>
                    <div class="mb-3">
                        <label for="ChooseSeats" class="form-label">Wybierz miejsca</label>
                        <input name="seats" type="number" class="form-control formVal" id="ChooseSeats" required min="0">
                    </div>

                    <button type="submit" class="btn btn-primary" id="submitbtn">Kup bilet</button>
                </form>
            </div>
        </div>
    </div>
</body>
<script src="<?= base_url() ?>assets/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url() ?>assets/js/main.js"></script>
<script>

</html>