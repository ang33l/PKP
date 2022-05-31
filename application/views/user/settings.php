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
                <a class="nav-link" href="<?= base_url() ?>user/account">Twoje dane</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url() ?>ticket/myTickets">Historia biletów</a>
            </li>
            <a class="nav-link" href="<?= base_url() ?>search/connections">Edytuj trasy</a>
            </li>
            </li>
            <a class="nav-link active" href="<?= base_url() ?>user/settings">Ustawienia</a>
            </li>
        </ul>
    </nav>
    <section>


        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h4>Zmiana hasła</h4>
                    <form action="javascript:confirmChangePassword()">
                        <div class="mb-3 col-md-8">
                            <label for="Old_pass" class="form-label">Podaj stare hasło</label>
                            <input name="old_pass" type="password" class="form-control formVal" id="Old_pass" required>
                        </div>
                        <div class="mb-3 col-md-8">
                            <label for="New_pass" class="form-label">Podaj nowe hasło</label>
                            <input name="new_pass" type="password" class="form-control formVal" id="New_pass" required>
                        </div>
                        <div class="mb-3 col-md-8">
                            <label for="Re_new_pass" class="form-label">Potwierdź nowe hasło</label>
                            <input name="re_new_pass" type="password" class="form-control formVal" id="Re_new_pass"
                                required>
                        </div>
                        <div class="mb-3" id="error-window" style="display:none">
                        </div>
                        <button type="submit" class="btn btn-primary" id="submitbtn">Zmień hasło</button>
                    </form>
                </div>
                <div class="col-md-6" style="font-size: 20px;">
                    <h4>Inne ustawienia</h4>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" />
                        <label class="form-check-label" for="flexSwitchCheckDefault">Jakieś ustawienie 1</label>
                    </div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault"
                            checked />
                        <label class="form-check-label" for="flexSwitchCheckDefault">Jakieś ustawienie 2</label>
                    </div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" />
                        <label class="form-check-label" for="flexSwitchCheckDefault">Jakieś ustawienie 3</label>
                    </div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault"
                            checked />
                        <label class="form-check-label" for="flexSwitchCheckDefault">Jakieś ustawienie 4</label>
                    </div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" />
                        <label class="form-check-label" for="flexSwitchCheckDefault">Jakieś ustawienie 5</label>
                    </div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" />
                        <label class="form-check-label" for="flexSwitchCheckDefault">Jakieś ustawienie 6</label>
                    </div>

                </div>
            </div>
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
function confirmChangePassword() {
    if (confirm("Na pewno chcesz zmienić hasło?")) changePassword();
}

function changePassword() {
    var elements = document.getElementsByClassName("formVal");
    var formData = new FormData();
    for (var i = 0; i < elements.length; i++) {
        formData.append(elements[i].name, elements[i].value);
    }
    if(document.getElementById("New_pass").value != document.getElementById("Re_new_pass").value){
        document.getElementById("error-window").style.display = "";
        document.getElementById("error-window").innerHTML =
                '<span class="text-danger">Nowe hasła nie są takie same!</span>';
        setTimeout('document.getElementById("error-window").style.display = "none"', 3000);
        return;
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
                for (var i = 0; i < elements.length; i++) {
                    elements[i].value = "";
                }
            }
        }
    }
    xmlHttp.open("post", "<?= base_url() ?>user/changePassword");
    xmlHttp.send(formData);
}
</script>

</html>