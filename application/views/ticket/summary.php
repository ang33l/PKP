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
                <form action="javascript:myFunction()">
                    <div class="mb-3">
                        <p>Trasa [skąd] - [dokąd]</p>
                        <p>Odjazd [hh-mm], przyjazd [hh-mm]</p>
                        <p>Ilość biletów: <?php echo $_POST['numSeats']  ?></p>
                        <p>Wybrane miejsce: <?php echo $_POST['seats']  ?></p>
                        <input type="hidden" name="numSeats" class="form-control formVal" value="<?php echo $_POST['numSeats']  ?>">
                        <input type="hidden" name="seats" class="form-control formVal" value="<?php echo $_POST['seats']  ?>">
                    </div>
                    <hr>
                    <div class="mb-3">
                        
                        <p>Wybierz płatność</p>
                        <div class="form-check">
                            <input name="payment" type="radio" class="form-check-input"  id="ChoosePayment1">
                            <label class="form-check-label" for="ChoosePayment1">Zapłać później</label>
                            </div>
                        <div class="form-check">
                            <input name="payment" type="radio" class="form-check-input"  id="ChoosePayment2">
                            <label class="form-check-label" for="ChoosePayment2">PayU</label>
                        </div>
                        
                    </div>

                    <button type="submit" class="btn btn-primary" id="submitbtn">Potwierdź</button>
                </form>
            </div>
        </div>
    </div>
</body>
<script src="<?= base_url() ?>assets/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url() ?>assets/js/main.js"></script>
<script>
function myFunction() {
    var elements = document.getElementsByClassName("formVal");
    var formData = new FormData();
    for (var i = 0; i < elements.length; i++) {
        formData.append(elements[i].name, elements[i].value);
    }
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function() {
        if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
            if (xmlHttp.responseText == "1") {
                console.log(xmlHttp.responseText);
                window.location.replace("<?= base_url() ?>");
            } else {
                document.getElementById("error-window").style.display = "";
            }
        }
    }
    xmlHttp.open("post", "<?= base_url() ?>ticket/confirmation");
    xmlHttp.send(formData);
}
</script>

</html>