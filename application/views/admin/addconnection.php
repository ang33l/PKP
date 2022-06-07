<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
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
    td{
        vertical-align: middle;
    }
    </style>
    <div class="bg">
        <div class="center-screen">
            <div class="col-xs-12 col-md-4 bg-light p-4 rounded">
                <a href="<?php echo base_url().'search/connections'?>" class="btn btn-danger float-end">Cofnij</a>
                <h2>Dodaj nową trasę</h2>
                <p>PKP Online</p>
                    <form action="<?php echo base_url().'search/addConn'?>" method="post">
                    <label for="pick">Wybierz dla którego pociągu chcesz utworzyć nową trasę:</label>

                        <select id="train_id" class="form-select" name="train_id" required>
                            <?php foreach($records as $r){?>
                                <option value="<?= $r->train_id?>"><?= $r->train_id?></option>
                            <?php }?>
                        </select><br>
                        
                        <button type="submit" class="btn btn-success" id="submitbtn">Dodaj trasę</button>
                    </form>
            </div>
        </div>
    </div>
</body>
<script src="<?= base_url() ?>assets/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url() ?>assets/js/main.js"></script>


</html>