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
        border: 0;
        padding: 10px 35px;
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
                <h2>Dodaj nowe przystanki</h2>
                <p>PKP Online</p>

                    <form action="<?php echo base_url().'search/addStops'?>" id="add_form" method="post">
                        <label for="pick">Wybierz dla której trasy chcesz dodać przystanki: </label>
                        <select class="col-md-0,5  mb-3" id="train_id" class="form-select" name="connection_id" required>
                            <?php foreach($records as $r){?>
                                <option value="<?= $r->connection_id?>"><?= $r->connection_id?></option>
                            <?php }?>
                        </select>
                        <div id="show_item">
                            <div class="row">
                                <div class="col-md-4">
                                    <input type="text" name="town[]" class="form-control" placeholder="Nazwa przystanku" required>
                                </div>
                                <div class="col-md-4">
                                    <input type="datetime" name="depature-time[]" id="pick_date" class="form-control picker" />
                                </div>
                                <div class="col-md-4 mb-3">
                                    <button class="btn btn-success add_item_btn d-grid">Dodaj kolejny</button>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary" id="submitbtn">Dodaj przystanki</button>
                    </form>
            </div>
        </div>
    </div>
</body>
<script src="<?= base_url() ?>assets/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url() ?>assets/js/main.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $(".add_item_btn").click(function(e){
            e.preventDefault();
            $("#show_item").prepend(`<div class="row">
                    <div class="col-md-4">
                        <input type="text" name="town[]" class="form-control" placeholder="Nazwa przystanku" required>
                    </div>
                    <div class="col-md-4">
                        <input type="datetime" name="depature-time[]" id="pick_date" class="form-control picker" >
                    </div>
                    <div class="col-md-4 mb-3">
                        <button class="btn btn-danger remove_item_btn d-grid">Usuń</button>
                    </div>
                    </div>`);
        });
        $(document).on('click', '.remove_item_btn', function(e){
            e.preventDefault();
            let row_item = $(this).parent().parent();
            $(row_item).remove();
        });
    });
</script>


<script>
conf = {
    enableTime: true,
    dateFormat: "Y-m-d H:i",
    time_24hr: true,
    //enableSeconds: true
    //minDate: "today"
}

flatpickr(".picker", conf);
</script>

</html>