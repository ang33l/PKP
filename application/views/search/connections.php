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
    td{
        vertical-align: middle;
    }
    </style>
    <div class="bg">
        <div class="center-screen">
            <div class="col-xs-12 col-md-4 bg-light p-4 rounded">
                <h2>Edytuj połączenia</h2>
                <p>PKP Online</p>
                <table class="table">
                    <tr>
                        <th>ID trasy</th>
                        <th>Skąd</th>
                        <th>Data przybycia</th>
                        <th>Akcje</th>
                    </tr>
                    <?php foreach($records as $row){?>
                    <tr>
                        <td><?= $row->connection_id ?></td>
                        <td><?= $row->town ?></td>
                        <td><?= $row->date ?></td>
                        <td>
                            <a href="<?php echo base_url().'search/deleteconn/'.$row->stops_id?>" class="btn btn-danger">Usuń</a>
                        </td>
                        <td>
                            <a href="<?php echo base_url().'search/edit/'.$row->stops_id?>" class="btn btn-primary">Edytuj</a>
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