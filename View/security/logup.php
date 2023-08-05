<?php
    require_once "../View/header.php";
?>

<section id="logup" class="full-height d-flex full-width login-logup" x-data="logup">
    <div>
        <template x-if="userM != null">
            <form id="form-logup" x-on:submit.prevent="sendForm()">
                <h1 class="text-center">Connectez-vous</h1>
                <div class="mb-3">
                    <label for="lastname" class="form-label">Nom*</label>
                    <input type="text" class="form-control" id="lastname" name="lastname" placeholder="lastname" x-model="userM['lastname']">
                    <template x-if="formValidation.errors?.lastname?.required != undefined">
                        <div class="alert alert-danger mt-1" x-text="formValidation.errors.lastname.required"></div>
                    </template>
                </div>
                <div class="mb-3">
                    <label for="firstname" class="form-label">Prénom*</label>
                    <input type="text" class="form-control" id="firstname" name="firstname" placeholder="firstname" x-model="userM['firstname']">
                    <template x-if="formValidation.errors?.firstname?.required != undefined">
                        <div class="alert alert-danger mt-1" x-text="formValidation.errors.firstname.required"></div>
                    </template>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Mail*</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="email" x-model="userM['email']">
                    <template x-if="formValidation.errors?.email?.required != undefined">
                        <div class="alert alert-danger mt-1" x-text="formValidation.errors.email.required"></div>
                    </template>
                    <template x-if="formValidation.errors?.email?.email != undefined">
                        <div class="alert alert-danger mt-1" x-text="formValidation.errors.email.email"></div>
                    </template>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Mot de passe*</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="mot de passe" autocomplete="on" x-model="userM['password']">
                    <template x-if="formValidation.errors?.password?.required != undefined">
                        <div class="alert alert-danger mt-1" x-text="formValidation.errors.password.required"></div>
                    </template>
                    <template x-if="formValidation.errors?.password?.minlength != undefined">
                        <div class="alert alert-danger mt-1" x-text="formValidation.errors.password.minlength"></div>
                    </template>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Envoyer</button>
                </div>
            </form>
        </template>
    </div>
    <div>
        <img src="files/ad2.png" alt="">
    </div>
</section>

<script src="./libs/FormValidation.js"></script>
<script src="./js/alpinejs/model/User.js"></script>
<script src="./js/alpinejs/login.js"></script>
<?php
    require_once "../View/footer.php";
?>