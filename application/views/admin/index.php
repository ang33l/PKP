
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
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Panel admina</a></li>
                <li class="breadcrumb-item active" aria-current="page">Start</li>
            </ol>
        </nav>
        <nav>
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Start</a>
                </li>
                <?php if($this->session->user_type_id==1){
                ?>
                <li>
                    <a class="nav-link" href="<?= base_url() ?>admin/users">Użytkownicy</a>
                </li>
                <?php }?>
                <li>
                    <a class="nav-link" href="<?= base_url() ?>search/connections">Trasy</a>
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
            <div class="container">
                <div class="col-md-12">
                    <h5>Znajdujesz się w panelu administratora.</h5>
                    <p>Z tego miejsca możesz przejść do poszczególnych sekcji powyżej w celu zarządzania systemem PKP Online.</p>
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