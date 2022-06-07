<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<style>
#nav2 {
    margin-top: 100px;
}
</style>



<div class="container">
    <nav id="nav2"
        style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
        aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
            <li class="breadcrumb-item"><a href="<?= base_url() ?>admin">Panel admina</a></li>
            <li class="breadcrumb-item active" aria-current="page">Trasy</li>
        </ol>
    </nav>
    <nav>
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link" aria-current="page" href="<?= base_url() ?>admin">Start</a>
            </li>
            <?php if($this->session->user_type_id==1){
                ?>
            <li>
                <a class="nav-link" href="<?= base_url() ?>admin/users">Użytkownicy</a>
            </li>
            <?php }?>
            <li>
                <a class="nav-link" href="<?= base_url() ?>admin/connections">Trasy</a>
            </li>
            <li>
                <a class="nav-link" href="<?= base_url() ?>admin/trains">Pociągi</a>
            </li>
            <li>
                <a class="nav-link" href="<?= base_url() ?>admin/carriages">Wagony</a>
            </li>
            <li>
                <a class="nav-link" href="<?= base_url() ?>admin/compartments">Przedziały</a>
            </li>
            <li>
                <a class="nav-link active" href="<?= base_url() ?>admin/tickets">Bilety</a>
                <!-- <a class="nav-link active" href="<?= base_url() ?>admin/compartments">Bilety</a> -->
            </li>
        </ul>
    </nav>
    <section>
    <div class="col-xs-12">
        <h5>Zarządzaj biletami użytkowików</h5>
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
                    <a href="<?php echo base_url().'admin/cancel/'.$row->ticket_id?>" onclick="javascript:return confirm('Czy na pewno chcesz anulować ten bilet?')" class="btn btn-danger">Anuluj</a>
                </td>
            </tr>
                        
             <?php }?>
        </table>
    </div>
            </section>
</div>
</div>
<footer>

    <div class="container d-md-flex py-4">

        <div class="me-md-auto text-center text-md-start">
            <div class="copyright">
                &copy; Copyright <strong><span>PKP Online</span></strong>. Wszelkie prawa zastrzeżone
            </div>
        </div>
    </div>
</footer>
</body>
<script src="<?= base_url() ?>assets/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url() ?>assets/js/main.js"></script>
<script>
< /html>