<?php
    require_once "../View/header.php";
?>

<div class="admin" id="admin-videos">
    <?php
        require_once "admin_right_nav.php";
    ?>
    <section x-data="adminvideos">
        <section id="admin-top-nav">
            <div><i class="bi bi-justify" id="btn-admin-right-nav"></i></div>
            <div></div>
        </section>
        <section class="admin-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 h1 fw-bold mb-4">Les videos</div>
                    <div class="col-md-4 col-lg-3 mb-4">
                        <h4>Ajouter une video</h4>
                        <template x-if="videoM != null">
                            <form id="form-video" x-on:submit.prevent="sendForm()" class="row">
                                <div class="col-12 mb-3">
                                    <div class="mb-2">
                                        <label for="title" class="form-label">Titre*</label>
                                        <input class="form-control" name="title" type="text" id="title" x-model="videoM['title']">
                                        <template x-if="formValidation.errors?.title?.required != undefined">
                                            <div class="alert alert-danger mt-1" x-text="formValidation.errors.title.required"></div>
                                        </template>
                                    </div>
                                </div>
                                <div class="col-12 mb-3">
                                    <div class="mb-2">
                                        <label for="url" class="form-label">Url*</label>
                                        <textarea class="form-control" name="url" id="url" rows="1" x-model="videoM['url']"></textarea>
                                        <template x-if="formValidation.errors?.url?.required != undefined">
                                            <div class="alert alert-danger mt-1" x-text="formValidation.errors.url.required"></div>
                                        </template>
                                    </div>
                                </div> 
                                <div class="col-12 mb-3">
                                    <div class="mb-2">
                                        <label for="formFile" class="form-label">Vignette*</label>
                                        <input class="form-control" type="file" name="thumbnail" id="formFile" @change="inputFileHandler($event)">
                                    </div>
                                    <template x-if="formValidation.errors?.thumbnail?.required != undefined">
                                        <div class="alert alert-danger mt-1" x-text="formValidation.errors.thumbnail.required"></div>
                                    </template>
                                    <template x-if="videoM['thumbnail'] !== ''">
                                        <div id="wrap-base64">
                                            <img :src="videoM['thumbnail']" alt="">
                                        </div>
                                    </template>
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="select-type" class="form-label">Type*</label>
                                    <select class="form-select" name="type" id="select-type" x-model="videoM['type']">
                                        <option value="">Choisir un type d'url</option>
                                        <option value="1">Iframe</option>
                                        <option value="2">Video</option>
                                        <option value="3">Url externe</option>
                                        <option value="4">TikTok</option>
                                        <option value="5">Vidéo intégrée</option>
                                    </select>
                                    <template x-if="formValidation.errors?.type?.required != undefined">
                                        <div class="alert alert-danger mt-1" x-text="formValidation.errors.type.required"></div>
                                    </template>
                                </div>
                                <div class="col-6">
                                    <button type="submit" class="btn btn-primary">Envoyer</button>
                                </div>
                                <div class="col-6 text-end">
                                    <button type="button" class="btn btn-dark" @click="resetForm()">Reset</button>
                                </div>
                            </form>
                        </template>
                    </div>
                    <div class="col-md-8 col-lg-9">
                        <div class="wrap-tab">
                            <input type="text" class="form-control form-control-sm mb-2" placeholder="rechercher..." @keyup="sortVideos($event)">
                            <table class="table" id="tableVideos">
                                <thead class="table-dark">
                                    <tr>
                                        <th scope="col">Id</th>
                                        <th scope="col">Titre</th>
                                        <th scope="col">Video</th>
                                        <th scope="col">Type</th>
                                        <th scope="col">Créé</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <template x-for="(item, index) in allVideos">
                                        <tr x-show="item['filter']==''">
                                            <th scope="row" x-text="item['id']"></th>
                                            <td x-text="item['title']"></td>
                                            <td>
                                                <img :src="item['thumbnail']" alt="">
                                            </td>
                                            <td x-text="getType(item['type'])"></td>
                                            <td x-text="item['created']"></td>
                                            <td>
                                                <button type="button" class="btn btn-info btn-sm me-2 mb-1" @click="setVideoM(index)">Modifier</button>
                                                <button type="button" class="btn btn-danger btn-sm me-2 mb-1" @click="deleteVideo(index)">Supprimer</button>
                                                <button type="button" class="btn btn-dark btn-sm" @click="setDisplayedVideo(item)">Lire</button>
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

        <template x-if="displayedVideo != null">
            <section id="section-video" class="full-height d-flex fixed-section">
                <div class="btn-close text-white fs-4">
                    <i class="bi bi-arrow-left pointer" @click="setDisplayedVideo(null)"></i>
                    Retour
                </div>
                <div class="wrap" x-html="displayedVideo['url']"></div>
            </section>
        </template>
    </section>
</div>

<script src="../libs/dataTable.js"></script>
<script src="../libs/FormValidation.js"></script>
<script src="../js/alpinejs/admin/videos.js"></script>
<?php
    require_once "../View/footer.php";
?>