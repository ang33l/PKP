<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PKP Online :: Wyszukiwanie połączeń</title>
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
    .btn-buy{
        background: green;
    }
    </style>
</head>

<body>
    <div class="bg">
        <div class="center-screen">
            <div class="col-xs-12 col-md-4 bg-light p-4 rounded">
                <h2>Dostępne połączenia</h2>
                <p>PKP Online</p>
                    <table>
                        <tr>
                            <td>Skąd</td>
                            <td>Dokąd</td>
                            <td>Data wyjazdu</td>
                            <td>Data przyjazdu</td>
                            <td>Godzina odjazdu</td>
                            <td>Godzina przyjazdu</td>
                        </tr>
                        <?php foreach($records as $row){?>
                        <tr>
                            <td><?php echo $row->from_where; ?></td>
                            <td><?php echo $row->to_where; ?></td>
                            <td><?php echo $row->depature_time; ?></td>
                            <td><?php echo $row->arrive_time; ?></td>
                            <td><?php echo $row->hour_of_depature; ?></td>
                            <td><?php echo $row->hour_of_arrive; ?></td>
                        </tr>
                        
                        <?php }?>
                    </table>
            </div>
        </div>
    </div>
</body>

<script src="<?= base_url() ?>assets/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url() ?>assets/js/main.js"></script>


</html>