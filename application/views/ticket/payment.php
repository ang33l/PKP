<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

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
    <div class="bg">
        <div class="center-screen">
            <div class="col-xs-12 col-md-4 bg-light p-4 rounded">
                <h2>Opłać bilet</h2>
                <p>PKP Online</p>
                <hr>
                <form action="<?= base_url() ?>ticket/mytickets" method="post"> 
                    <input type="hidden" name="payment" class="form-control formVal" value="1">
                    <div class="mb-3">
                        <p>Płatność</p>
                        <div class="mb-3">
                            <label for="blikCode" class="form-label">Wpisz kod BLIK</label>
                            <input name="blikCode" class="form-control formVal" id="blikCode" required type="text" pattern="\d*" maxlength="6">
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

</html>