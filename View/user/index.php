<?php
    require_once "../View/header.php";
?>

<section id="profile" class="pinterest" x-data="profile">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 col-lg-3">
                <section id="section-menus">
                    <div class="menu"></div>
                    <div class="menu">
                        <a href="/">Accueil</a>
                    </div>
                    <div class="menu" :class="{'active': section==1}" @click="switchSection(1)">
                        <span>Informations personnelles</span>
                    </div>
                    <div class="menu" :class="{'active': section==2}" @click="switchSection(2)">
                        <span>Mot de passe</span>
                    </div>
                    <div class="menu">
                        <span>Mes amis</span>
                    </div>
                    <div class="menu">
                        <span>Historique</span>
                    </div>
                    <div class="menu">
                        <span>Service client</span>
                    </div>
                    <div class="menu">
                        <span>Confidentialité et données</span>
                    </div>
                </section>
            </div>
            <div class="col-md-8 col-lg-9">
                <section id="section-content">
                    <template x-if="section==1">
                        <section class="content">
                            <h1 class="mb-3">Informations personnelles</h1>
                            <template x-if="formValidation != null && userM != null">
                                <form class="row justify-content-center" x-on:submit.prevent="saveUser()">
                                    <div class="col-md-4 mb-3">
                                        <div class="mb-3 ps-1 pe-1">
                                            <label for="formFile" class="form-label">Photo</label>
                                            <input class="form-control" type="file" id="formFile" @change="handleInputFile($event)">
                                        </div>
                                        <img :src="userM['photo']">
                                    </div>
                                    <div class="col-md-8">
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
                                            <label for="firstname" class="form-label">Date d'inscription</label>
                                            <input type="text" class="form-control" :value="userM['created']" disabled>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">Envoyer</button>
                                        </div>
                                    </div>
                                    <div class="col-md-7 col-lg-6 mt-4">
                                        <div id="image-container">
                                            <img :src="userM['photo']" id="cropper-image" x-ref="cropperImage">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-lg-4 mt-2" x-show="userM['photo'] != ''">
                                        <div>
                                            <button type="button" class="btn btn-success" @click="croppeImage()">Recadrer</button>
                                        </div>
                                    </div>
                                <form>
                            </template>
                        </section>
                    </template>

                    <template x-if="section==2">
                        <section class="content">
                            <h1 class="mb-3">Mot de passe</h1>
                            <template x-if="formValidation != null && userM != null">
                                <form class="row justify-content-center" x-on:submit.prevent="saveUser()">
                                </form>
                            </template>
                        </section>
                    </template>
                </section>
            </div>
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/cropperjs/dist/cropper.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/cropperjs/dist/cropper.css">
<script src="./libs/FormValidation.js"></script>
<script src="./js/alpinejs/model/User.js"></script>
<script src="./js/alpinejs/user.js"></script>
<?php
    require_once "../View/footer.php";
?>