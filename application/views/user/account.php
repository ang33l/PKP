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
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Strefa pasażera</a></li>
                <li class="breadcrumb-item active" aria-current="page">Moje konto</li>
            </ol>
        </nav>
        <nav>
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Twoje dane</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url() ?>ticket/myTickets">Historia biletów</a>
                </li>
                    <a class="nav-link" href="<?= base_url() ?>search/connections">Edytuj trasy</a>
                </li>
                </li>
                    <a class="nav-link" href="<?= base_url() ?>user/settings">Ustawienia</a>
                </li>
            </ul>
        </nav>
        <section>
            <div class="container">
                <div class="col-md-6">
                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                <td>Imię</td>
                                <td><?= $user_data->first_name ?></td>
                            </tr>
                            <tr>
                                <td>Nazwisko</td>
                                <td><?= $user_data->last_name ?></td>
                            </tr>
                            <tr>
                                <td>Login</td>
                                <td><?= $user_data->user_name ?></td>
                            </tr>
                            <tr>
                                <td>Adres e-mail</td>
                                <td><?= $user_data->email ?></td>
                            </tr>
                            <tr>
                                <td>Typ</td>
                                <td><?= $user_data->name ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-6">

                </div>
            </div>
        </section>
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

</html>