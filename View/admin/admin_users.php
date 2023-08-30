<?php
    require_once "../View/header.php";
?>

<div class="admin" id="admin-users">
    <?php
        require_once "admin_right_nav.php";
    ?>
    <section x-data="adminusers">
        <section id="admin-top-nav">
            <div><i class="bi bi-justify" id="btn-admin-right-nav"></i></div>
            <div></div>
        </section>
        <section class="admin-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 h1 fw-bold mb-4">Les utilisateurs</div>
                    <template x-If="displayedForm==true">
                        <div class="col-12 mb-4">
                            <div id="wrap-form">
                                <form id="form-user" x-on:submit.prevent="sendForm()" class="row">
                                    <div class="col-md-6 col-lg-4 mb-3">
                                        <label for="lastname" class="form-label">Nom*</label>
                                        <input type="text" class="form-control" id="lastname" x-model="userM['lastname']">
                                    </div>
                                    <div class="col-md-6 col-lg-4 mb-3">
                                        <label for="firstname" class="form-label">Prénom*</label>
                                        <input type="text" class="form-control" id="firstname" x-model="userM['firstname']">
                                    </div>
                                    <div class="col-md-6 col-lg-4 mb-3">
                                        <label for="email" class="form-label">Mail*</label>
                                        <input type="email" class="form-control" id="email" x-model="userM['email']">
                                    </div>
                                    <div class="col-md-6 col-lg-4 mb-3">
                                        <label for="formFile" class="form-label">Photo</label>
                                        <input class="form-control mb-2" type="file" id="formFile" @change="inputFileHandler($event)">
                                        <template x-if="photoBase64 != ''">
                                            <img :src="photoBase64" alt="">
                                        </template>
                                    </div>
                                    <div class="col-md-6 col-lg-4 mb-3">
                                    <template x-if="userM['photo'] != ''">
                                            <img :src="userM['photo']" alt="">
                                        </template>
                                    </div>
                                    <div class="col-md-6 col-lg-4 mb-3">
                                        <label class="form-label">Rôles</label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="role_user" id="role_user" @change="switchRights($event)" :checked="userM['roles'].includes('role_user')">
                                            <label class="form-check-label" for="role_user">
                                                Utilisateur
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="role_admin" id="role_admin" @change="switchRights($event)" :checked="userM['roles'].includes('role_admin')">
                                            <label class="form-check-label" for="role_admin">
                                                Administrateur
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="role_admin_super" id="role_admin_super" @change="switchRights($event)" :checked="userM['roles'].includes('role_admin_super')">
                                            <label class="form-check-label" for="role_admin_super">
                                                Super Administrateur
                                            </label>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-6">
                                            <button type="submit" class="btn btn-primary">Envoyer</button>
                                        </div>
                                        <div class="col-6 text-end">
                                            <button type="button" class="btn btn-dark" @click="switchFormSection(0)">Fermer</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </template>
                    
                    <div class="col-12 mb-2">
                        <div class="row justify-content-between">
                            <div class="col-6 col-md-5 col-lg-4">
                                <input type="text" class="form-control" placeholder="nom, prénom, mail" @keyup="searchByKeywords($event)">
                            </div>
                            <div class="col-6 col-md-3 text-end">
                                <button type="button" class="btn btn-success" @click="switchFormSection(1)">Ajouter</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <table class="table table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Nom</th>
                                    <th scope="col">Prénom</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Photo</th>
                                    <th scope="col">Rôles</th>
                                    <th scope="col">Créé</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <template x-for="(item, index) in allUsers">
                                    <tr x-show="item['filter']==''">
                                        <th scope="row" x-text="item['id']"></th>
                                        <td x-text="item['lastname']"></td>
                                        <td x-text="item['firstname']"></td>
                                        <td x-text="item['email']"></td>
                                        <td>
                                            <template x-If="item['photo'] != ''">
                                                <img :src="item['photo']" alt="">
                                            </template>
                                        </td>
                                        <td>
                                            <ul>
                                            <template x-for="(item2, index2) in item['roles']">
                                                <li x-text="item2"></li>
                                            </template>
                                            </ul>
                                        </td>
                                        <td x-text="item['created']"></td>
                                        <td>
                                            <button type="button" class="btn btn-info text-white btn-sm me-2 mb-1" @click="switchFormSection(1, index)">Modifier</button>
                                            <button type="button" class="btn btn-danger btn-sm me-2 mb-1" @click="deleteuser(index)">Supprimer</button>
                                            <button type="button" class="btn btn-warning btn-sm text-white" @click="changePassword(index)">Mot de passe</button>
                                        </td>
                                    </tr>
                                </template>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </section>
</div>

<script src="../js/alpinejs/admin/users.js"></script>
<?php
    require_once "../View/footer.php";
?>