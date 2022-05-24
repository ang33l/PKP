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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

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
                <h2>Wyszukiwanie połączeń</h2>
                <p>PKP Online</p>
                <hr>
                <form action="<?php echo site_url('search/keyword'); ?>" method="post">
                    <div class="mb-3">
                        <label for="" class="form-label">Skąd</label>
                        <input name="from-where" type="text" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Dokąd</label>
                        <input name="to-where" type="text" class="form-control" >
                    </div>
                    <div class="mb-3" class="form-label">
                        <label for="">Wybierz datę</label>
                        <input name="depature-time" id="pick_date" type="datetime-local" class="form-control"/>
                    </div>

                    <button type="submit" class="btn btn-primary" id="submitbtn">Wyszukaj połączenia</button>
                </form>
            </div>
        </div>
    </div>
</body>

<script src="<?= base_url() ?>assets/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url() ?>assets/js/main.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script>
    conf={
        enableTime: true,
        dateFormat: "Y-m-d H:i",
        time_24hr: true,
        //minDate: "today"
    }

    flatpickr("#pick_date", conf);
</script>


</html>