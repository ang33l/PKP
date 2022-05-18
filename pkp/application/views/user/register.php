<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PKP Online :: Rejestracja</title>
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
                <h2>Rejestracja</h2>
                <p>PKP Online</p>
                <hr>
                <form action="javascript:myFunction()">
                    <div class="mb-3">
                        <label for="Login" class="form-label">Login</label>
                        <input name="login" type="text" class="form-control formVal" id="Login" required>
                    </div>
                    <div class="mb-3">
                        <label for="E-mail" class="form-label">E-mail</label>
                        <input name="email" type="email" class="form-control formVal" id="E-mail" required>
                    </div>
                    <div class="mb-3">
                        <label for="Password" class="form-label">Hasło</label>
                        <input name="pass" type="password" class="form-control formVal" id="Password" required>
                    </div>
                    <div class="mb-3">
                        <label for="RePassword" class="form-label">Powtórz hasło</label>
                        <input name="repass" type="password" class="form-control formVal" id="RePassword" required>
                    </div>
                    <div class="mb-3">
                        <label for="Firstname" class="form-label">Imię</label>
                        <input name="firstname" type="text" class="form-control formVal" id="Firstname" required>
                    </div>
                    <div class="mb-3">
                        <label for="Lastname" class="form-label">Nazwisko</label>
                        <input name="lastname" type="text" class="form-control formVal" id="Lastname" required>
                    </div>

                    <div class="mb-3" id="error-window" style="display:none">
                        <span class="text-danger">Nieprawidłowy login lub hasło!</span>
                    </div>

                    <button type="submit" class="btn btn-primary" id="submitbtn">Zarejestruj się</button>
                    <div class="mt-3">Masz już konto? <a href="<?= base_url() ?>user/register">Zaloguj się!</a>
                    </div>
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
    xmlHttp.open("post", "<?= base_url() ?>user/verifyRegister");
    xmlHttp.send(formData);
}
</script>

</html>