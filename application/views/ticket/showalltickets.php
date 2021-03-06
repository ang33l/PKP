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
            <div class="col-xs-12 col-md-8 bg-light p-4 rounded">
                <h2>Historia biletów</h2>
                <p>PKP Online</p>
                <hr>
                <p>Zarządzaj zakupionymi biletami</p>
                <table class="table">
                        <tr>
                            <td>Numer biletu	</td>
                            <td>Użytkownik	</td>
                            <td>Numer polaczenia	</td>
                            <!-- <td>ID pociagu </td> -->
                            <!-- <td>miejsca	</td> -->
                            <!-- <td>przedzial</td> -->
                            <td>Status</td>
                            <td>Data zakupu</td>
                            <td>Początek</td> 
                            <td>Koniec</td> 
                            <td>Status płatności</td>
                            <td>Akcje</td>
                            <td></td>
                        </tr>
                        <?php foreach($records as $row){?>
                            
                        <tr>
                            <td><?php echo $row->ticket_id; ?></td>
                            <td><?php echo $row->user_name; ?></td>
                            <td><?php echo $row->connection_id; ?></td>
                            <!-- <td><?php echo $row->train_id; ?></td> -->
                            <!-- <td><?php echo $row->position; ?></td> -->
                            <!-- <td><?php echo $row->compartment; ?></td> -->
                            <td><?php if($row->active==0) echo "nieaktywne"; else echo "aktywne"; ?></td>
                            <td><?php echo $row->buytime; ?></td>
                            <td><?php echo $row->start; ?></td> 
                            <td><?php echo $row->end; ?></td> 
                            <td><?php if($row->payment==0) echo "nieopłacone"; else echo "opłacone"; ?></td>
                            <td>
                                <?php
                                    $_SESSION['position'] = $row->position;
                                ?>
                                <button class="btn btn-danger" onclick="confirmAction()">Anuluj</button>
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
<script>
      function confirmAction() {
        let confirmAction = confirm("Czy na pewno chcesz anulować ten bilet?");
        if (confirmAction) {
            window.location.href = "<?php echo base_url().'ticket/cancel/'.$row->ticket_id?>";

        } else {
            alert("Anulowanie biletu zostało przerwane");
        }
      }
</script>

</html>