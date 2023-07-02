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
                            <form id="form-photo" x-on:submit.prevent="sendForm()" class="row">
                                <div class="col-12 mb-3">
                                    <div class="mb-2">
                                        <label for="title" class="form-label">Titre*</label>
                                        <input class="form-control mb-2" type="text" id="title" x-model="videoM['title']">
                                    </div>
                                    
                                </div>
                                <div class="col-12 mb-3">
                                    <div class="mb-2">
                                        <label for="url" class="form-label">Url*</label>
                                        <textarea class="form-control" id="url" rows="1" x-model="videoM['url']"></textarea>
                                    </div>
                                </div> 
                                <div class="col-12 mb-3">
                                    <div class="mb-2">
                                        <label for="formFile" class="form-label">Vignette*</label>
                                        <input class="form-control mb-2" type="file" id="formFile" @change="inputFileHandler($event)">
                                    </div>
                                    <template x-if="videoM['thumbnail'] !== ''">
                                        <div id="wrap-base64">
                                            <img :src="videoM['thumbnail']" alt="">
                                        </div>
                                    </template>
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="select-type" class="form-label">Type*</label>
                                    <select class="form-select" id="select-type" x-model="videoM['type']">
                                        <option value="">Choisir un type d'url</option>
                                        <option value="1">Iframe</option>
                                        <option value="2">Video</option>
                                        <option value="3">Url externe</option>
                                        <option value="4">TikTok</option>
                                    </select>
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
                                                <button type="button" class="btn btn-dark btn-sm">Lire</button>
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

<script src="../libs/dataTable.js"></script>
<script src="../js/alpinejs/admin/videos.js"></script>
<?php
    require_once "../View/footer.php";
?>