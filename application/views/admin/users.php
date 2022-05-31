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
            <li class="breadcrumb-item active" aria-current="page">Użytkownicy</li>
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
                <a class="nav-link active" href="<?= base_url() ?>admin/users">Użytkownicy</a>
            </li>
            <?php }?>
            <li>
                <a class="nav-link" href="<?= base_url() ?>admin/connections">Trasy</a>
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
            <div class="row">
                <div class="col-md-6">
                    <h5>Zarządzanie uprawnieniami użytkowników</h5>
                    <form action="javascript:getUser()">
                        <div class="mb-3 col-md-8">
                            <label for="Login" class="form-label">Podaj login lub adres e-mail użytkownika, któremu
                                chcesz
                                zmienić uprawnienia</label>
                            <input name="login" type="text" class="form-control formVal" id="Login" required>
                        </div>
                        <div class="mb-3" id="error-window" style="display:none">
                        </div>
                        <button type="submit" class="btn btn-primary" id="submitbtn">Wyszukaj użytkownika</button>
                    </form>
                </div>
                <div class="col-md-6" id="data-container" style="display:none">
                    <h5>Aktualny status użytkownika</h5>
                    <table class="table">
                        <tr>
                            <td>Login</td>
                            <td id="user-login"></td>
                        </tr>
                        <tr>
                            <td>Adres e-mail</td>
                            <td id="user-email"></td>
                        </tr>
                        <tr>
                            <td>Poziom uprawnień</td>
                            <td id="user-type-name"></td>
                        </tr>
                    </table>
                    <form action="javascript:confirmUpdate()">
                        <div class="mb-3 col-md-8">
                            <label for="Type" class="form-label">Zmień uprawnienia</label>
                            <select id="Type" name="type" class="form-select formVal1" required>
                                <option value="1">head_admin</option>
                                <option value="2">admin</option>
                                <option value="3">user</option>
                            </select>
                            <input type="text" id="user-id" name="user_id" class="formVal1" value="" hidden>
                        </div>
                        <div class="mb-3" id="error-window1" style="display:none">
                        </div>
                        <button type="submit" class="btn btn-primary" id="submitbtn">Zatwierdź zmiany</button>
                    </form>
                </div>
            </div>
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
<script>
function getUser() {
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
                setTimeout('document.getElementById("error-window").style.display = "none"', 1000);
                document.getElementById("data-container").style.display = "";
                document.getElementById("user-login").innerHTML = response.data.user_name;
                document.getElementById("user-email").innerHTML = response.data.email;
                document.getElementById("user-type-name").innerHTML = response.data.user_type_name;
                document.getElementById("user-id").value = response.data.user_id;
            }
        }
    }
    xmlHttp.open("post", "<?= base_url() ?>admin/findUser");
    xmlHttp.send(formData);
}

function confirmUpdate() {
    if (confirm("Na pewno chcesz zmienić uprawnienia?")) updateUserType();
}

function updateUserType() {
    var elements = document.getElementsByClassName("formVal1");
    var formData = new FormData();
    for (var i = 0; i < elements.length; i++) {
        formData.append(elements[i].name, elements[i].value);
    }
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function() {
        if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
            var response = JSON.parse(xmlHttp.responseText);
            document.getElementById("error-window1").style.display = "";
            document.getElementById("error-window1").innerHTML =
                '<span class="text-' +
                response.type + '">' +
                response.message +
                '</span>';
            if (response.type == "success") {
                setTimeout('document.getElementById("error-window1").style.display = "none"', 2000);
                setTimeout('document.getElementById("data-container").style.display = "none"', 2000);
                document.getElementById("Login").value = "";
            }
        }
    }
    xmlHttp.open("post", "<?= base_url() ?>admin/updateUserType");
    xmlHttp.send(formData);
}
</script>

</html>