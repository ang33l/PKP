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
                <a class="nav-link active" href="<?= base_url() ?>admin/connections">Trasy</a>
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
                <a class="nav-link" href="<?= base_url() ?>admin/tickets">Bilety</a>
            </li>
        </ul>
    </nav>
    <div class="col-xs-12">
        <h3>Trasy</h3>
        <h5>Zarządzanie trasami</h5>
            <a href="<?php echo base_url().'search/showconn'?>" class="btn btn-success">Dodaj trasę</a>
            <a href="<?php echo base_url().'search/showstops'?>" class="btn btn-success">Dodaj przystanki</a>
        <table class="table">
            <tr>
                <th>ID trasy</th>
                <th>Skąd</th>
                <th>Data przybycia</th>
                <th>Akcje</th>
                <th></th>
            </tr>
            <?php foreach($records as $row){?>
            <tr>
                <td><?= $row->connection_id ?></td>
                <td><?= $row->town ?></td>
                <td><?= $row->date ?></td>
                <td>
                    <a href="<?php echo base_url().'search/deleteconn/'.$row->stops_id?>"
                        class="btn btn-danger" onclick="javascript:return confirm('Czy na pewno chcesz usunąć ten przystanek?')">Usuń</a>
                </td>
                <td>
                    <a href="<?php echo base_url().'search/edit/'.$row->stops_id?>" class="btn btn-primary">Edytuj</a>
                </td>
            </tr>
            <?php }?>
        </table>
        <?= $this->pagination_bootstrap->render()?>
    </div>
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