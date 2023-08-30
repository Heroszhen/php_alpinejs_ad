<?php
    require_once "../View/header.php";
?>

<section id="login" class="full-height d-flex full-width login-logup" x-data="login">
    <div>
        <form id="form-login" x-on:submit.prevent="sendForm()">
            <h1 class="text-center">Connectez-vous</h1>
            <div class="mb-3">
                <label for="email" class="form-label">Mail*</label>
                <input type="email" class="form-control" id="email" placeholder="email" x-model="loginM['email']">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Mot de passe*</label>
                <input type="password" class="form-control" id="password" placeholder="mot de passe" autocomplete="on" x-model="loginM['password']">
            </div>
            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-primary">Envoyer</button>
                <a class="btn btn-outline-info" href="/mot-de-passe-oublie">Mot de passe oublié?</a>
            </div>
        </form>
    </div>
    <div>
        <img src="files/ad1.png" alt="">
    </div>
</section>

<script src="./js/alpinejs/login.js"></script>
<?php
    require_once "../View/footer.php";
?>