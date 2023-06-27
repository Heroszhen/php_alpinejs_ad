<?php
    require_once "../View/header.php";
?>

<div class="admin" id="admin-photos">
    <?php
        require_once "admin_right_nav.php";
    ?>
    <section x-data="adminphotos">
        <section id="admin-top-nav">
            <div><i class="bi bi-justify" id="btn-admin-right-nav"></i></div>
            <div></div>
        </section>
        <section class="admin-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 h1 fw-bold mb-4">Les photos</div>
                    <div class="col-md-5 mb-4">
                        <h4>Ajouter une photo</h4>
                        <form id="form-photo" x-on:submit.prevent="sendForm()" class="row">
                            <div class="col-12 mb-3">
                                <div class="mb-2">
                                    <label for="lastname" class="form-label">Url</label>
                                    <input type="text" class="form-control" id="url" x-model="photoM['url']" @change="switchUrl(1)">
                                </div>
                                <template x-if="photoM['url'] !== ''">
                                    <img :src="photoM['url']" alt="">
                                </template>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="mb-2">
                                    <label for="formFile" class="form-label">Base64</label>
                                    <input class="form-control mb-2" type="file" id="formFile" @change="inputFileHandler($event),switchUrl(2)">
                                </div>
                                <template x-if="photoM['base64'] !== ''">
                                    <div id="wrap-base64">
                                        <img :src="photoM['base64']" alt="">
                                    </div>
                                </template>
                            </div>
                            <div class="col-6">
                                <button type="submit" class="btn btn-primary">Envoyer</button>
                            </div>
                            <div class="col-6 text-end">
                                <button type="button" class="btn btn-dark" @click="resetPhotoM()">Reset</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-7">
                        <div class="wrap-tab1">
                            <table class="table">
                                <thead class="table-dark">
                                    <tr>
                                        <th scope="col">Id</th>
                                        <th scope="col">Photo</th>
                                        <th scope="col">Créé</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                            </table>
                        <div>
                        <div class="wrap-tab2">
                            <table class="table table-hover">
                                <tbody>
                                    <template x-for="(item, index) in allPhotos">
                                        <tr x-show="item['filter']==''">
                                            <th scope="row" x-text="item['id']"></th>
                                            <td>
                                                <img :src="item['url']" alt="">
                                            </td>
                                            <td x-text="item['created']"></td>
                                            <td>
                                                <button type="button" class="btn btn-danger btn-sm" @click="deleteuser(index)">Supprimer</button>
                                            </td>
                                        </tr>
                                    </template>
                                </tbody>
                            </table>
                        <div>
                    </div>
                </div>
            </div>
        </section>
    </section>
</div>

<script src="../js/alpinejs/admin/photos.js"></script>
<?php
    require_once "../View/footer.php";
?>