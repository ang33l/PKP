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
            <?php if($this->session->loggedIn){ ?>
                <h2>Kup bilet</h2>
                <p>PKP Online</p>
                <hr>
                <?php
                    $_SESSION['from'] = $_GET['from'];
                    $_SESSION['to'] = $_GET['to'];
                    $_SESSION['date_from'] = $_GET['date_from'];
                    $_SESSION['date_to'] = $_GET['date_to'];
                    $_SESSION['connection_id'] = $_GET['connection_id'];
                    $_SESSION['id_start'] = $_GET['id_start'];
                    $_SESSION['id_end'] = $_GET['id_end'];
                ?>
                <p>Kupno biletu na trasie: <?php echo $this->session->from?> - <?php echo $this->session->to?> </p> 
                <!-- <p>Kupno biletu na trasie: <?php echo $_GET['from']?> - <?php echo $_GET['to']?> -->
                <p>Czas odjazdu: <?php echo $this->session->date_from?> </p> 
                <!-- <p>Czas odjazdu: <?php echo $_GET['date_from'];?> </p> -->
                
                <p>Czas przyjazdu: <?php echo $this->session->date_to?> </p> 
                <!-- <p>Czas przyjazdu: <?php echo $_GET['date_to'];?> </p> -->
                <?php echo validation_errors(); ?>
                <form action="<?= site_url() ?>ticket/confirmation" method="post"> 
                    <div class="mb-3">
                        <label for="NumberOfSeats" class="form-label">Ilość miejsc</label>
                        <input name="numSeats" type="number" class="form-control formVal" id="NumberOfSeats" required min="0">
                    </div>
                    <!--  
                    <div class="mb-3">
                        <label for="ChooseSeats" class="form-label">Wybierz miejsca</label>
                        <input name="seats" type="number" class="form-control formVal" id="ChooseSeats" required min="0">
                    </div>
                    -->
                    <hr>
                    <p>Płatność</p>
                    <div class="form-check">
                            <input name="payment" type="radio" class="form-check-input" id="ChoosePayment1" value="later" required>
                            <label class="form-check-label" for="ChoosePayment1">Zapłać później</label>
                        </div>
                        <div class="form-check">
                            <input name="payment" type="radio" class="form-check-input"  id="ChoosePayment2" value="blik" required>
                            <label class="form-check-label" for="ChoosePayment2">BLIK</label>
                        </div> </br>
                    <button type="submit" class="btn btn-primary" id="submitbtn">Kup bilet</button>
                </form>
            </div>
            <?php
                } else { 
                    redirect(base_url().'user/login');
                }            
            ?>
        </div>
    </div>
</body>
<script src="<?= base_url() ?>assets/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url() ?>assets/js/main.js"></script>
<script>

</html>