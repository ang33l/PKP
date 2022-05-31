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
                <a class="nav-link" href="<?= base_url() ?>user/settings">Pociągi</a>
            </li>
            <li>
                <a class="nav-link" href="<?= base_url() ?>user/settings">Wagony</a>
            </li>
            <li>
                <a class="nav-link" href="<?= base_url() ?>user/settings">Przedziały</a>
            </li>
        </ul>
    </nav>
    <section>
            <div class="col-xs-12">
                <h2>Trasy</h2>
                <table class="table">
                    <tr>
                        <th>ID trasy</th>
                        <th>Skąd</th>
                        <th>Data przybycia</th>
                        <th>Akcje</th><th></th>
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