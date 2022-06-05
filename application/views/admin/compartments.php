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
                <a class="nav-link active" href="<?= base_url() ?>admin/compartments">Przedziały</a>
            </li>
        </ul>
    </nav>
    <section>
        <div class="container">
            <div class="col-md-12">
                <h5>Zarządzanie przedziałami</h5>
                <button type="button" id="addNew" class="btn btn-success" data-toggle="modal" data-target="#addModal">
                    <i class="bi bi-plus-circle"></i> Dodaj nowy przedział
                </button>
                <table class="table">
                    <tr>
                        <th>Id przedziału</th>
                        <th>Liczba miejsc</th>
                        <th>Typ</th>
                        <th>Akcje</th>
                        <th></th>
                    </tr>
                    <?php $lp = 1;
            foreach($records as $row){?>
                    <tr>
                        <td><?= $row['compartment_id'] ?></td>
                        <td><?= $row['quantity_seats'] ?></td>
                        <td><?= $row['type'] ?></td>
                        <td>
                            <button class="btn btn-danger delete-compartments"
                                data-value='<?php echo base_url().'admin/compartmentDelete/'.$row['compartment_id']?>'>
                                Usuń
                            </button>
                        </td>
                        <td>
                            <a href="<?php echo base_url().'admin/compartmentEdit/'.$row['compartment_id']?>"
                                class="btn btn-primary">Edytuj</a>
                        </td>
                    </tr>
                    <?php $lp++; }?>
                </table>

            </div>
        </div>
    </section>
</div>
</div>
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Dodaj nowy przedział</h5>
                <button type="button" id="closeAdd" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="javascript:compartmentAdd()">
                <div class="modal-body">

                    <div class="mb-3 col-md-8">
                        <label for="Quantity_seats" class="form-label">Ilość miejsc</label>
                        <input name="quantity_seats" type="number" min="1" class="form-control formVal"
                            id="Quantity_seats" required>
                        <label for="Type" class="form-label">Typ</label>
                        <select id="Type" name="type" class="form-select formVal" required>
                            <option value="1. klasa">1. klasa</option>
                            <option value="2. klasa">2. klasa</option>
                        </select>
                    </div>
                    <div class="mb-3" id="error-window" style="display:none">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" id="dismissAdd" class="btn btn-secondary" data-dismiss="modal">Anuluj</button>
                    <button type="submit" class="btn btn-primary" id="submitbtn">Zatwierdź zmiany</button>
                </div>
            </form>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>
$('#addNew').click(function() {
    $('#addModal').modal('show')
});
$('#dismissAdd').click(function() {
    $('#addModal').modal('hide')
});
$('#closeAdd').click(function() {
    $('#addModal').modal('hide')
});
$('.delete-compartments').click(function(e) {
    if(confirm("Czy na pewno chcesz usunąć ten przedział?")){
        window.location.replace(e.target.getAttribute('data-value'));
    }
});

function compartmentAdd() {
    var elements = document.getElementsByClassName("formVal");
    var formData = new FormData();
    for (var i = 0; i < elements.length; i++) {
        formData.append(elements[i].name, elements[i].value);
    }
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function() {
        if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
            var response = JSON.parse(xmlHttp.responseText);
            document.getElementById("error-window").style.display = "";
            document.getElementById("error-window").innerHTML =
                '<span class="text-' +
                response.type + '">' +
                response.message +
                '</span>';
            if (response.type == "success") {
                setTimeout('document.getElementById("error-window").style.display = "none"', 2000);
                setTimeout('window.location.reload(true)', 3000);
            }
        }
    }
    xmlHttp.open("post", "<?= base_url() ?>admin/compartmentAdd");
    xmlHttp.send(formData);
}
</script>

</html>