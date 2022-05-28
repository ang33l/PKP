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
    /*
    .center-screen button {
        background: #1977cc;
        border: 0;
        padding: 10px 35px;
        background-color: #1977cc;
        transition: 0.4s;
        border-radius: 50px;
    } */
    td{
        vertical-align: middle;
    }
    </style>
    <div class="bg">
        <div class="center-screen">
            <div class="col-xs-12 col-md-7 bg-light p-4 rounded">
                <h2>Moje bilety</h2>
                <p>PKP Online</p>
                <hr>
                <p>Historia zakupionych biletów</p>
                <table class="table">
                        <tr>
                            <td>Ilość	</td>
                            <td>ID biletu	</td>
                            <td>ID user	</td>
                            <td>ID polaczenia	</td>
                            <!-- <td>ID pociagu </td> -->
                            <td>miejsce	</td>
                            <!-- <td>przedzial</td> -->
                            <td>active</td>
                            <td>data zakupu</td>
                            <!-- <td>start</td> -->
                            <!-- <td>end</td> -->
                            <td>payment</td>
                            <td>Akcje</td>
                            <td></td>
                        </tr>
                        <?php foreach($records as $row){?>
                            
                        <tr>
                            <td><?php echo $row->ilosc; ?></td>
                            <td><?php echo $row->ticket_id; ?></td>
                            <td><?php echo $row->user_id; ?></td>
                            <td><?php echo $row->connection_id; ?></td>
                            <!-- <td><?php echo $row->train_id; ?></td> -->
                            <td><?php echo $row->position; ?></td>
                            <!-- <td><?php echo $row->compartment; ?></td> -->
                            <td><?php echo $row->active; ?></td>
                            <td><?php echo $row->buytime; ?></td>
                            <!-- <td><?php echo $row->start; ?></td> -->
                            <!-- <td><?php echo $row->end; ?></td> -->
                            <td><?php echo $row->payment; ?></td>
                            
                            <td>
                            <a href="<?php echo base_url().'ticket/cancel/'.$row->ticket_id?>" onclick="javascript:return confirm('Czy na pewno chcesz anulować wszystkie bilety?')" class="btn btn-danger">Anuluj</a> 
                            </td>
                            <td>
                                <?php if ($row->payment == 0) { ?>
                                <a href="<?php echo base_url().'ticket/pay/'.$row->ticket_id?>" class="btn btn-primary">Opłać</a>
                                <?php } ?>
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

</html>