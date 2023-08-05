<?php
    require_once "../View/header.php";
?>

<div class="admin" id="admin-articles">
    <?php
        require_once "admin_right_nav.php";
    ?>
    <section x-data="adminarticles">
        <section id="admin-top-nav">
            <div><i class="bi bi-justify" id="btn-admin-right-nav"></i></div>
            <div></div>
        </section>
        <section class="admin-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 h1 fw-bold mb-4">Les articles</div>
                <div class="col-md-8 col-lg-7 mb-4">
                    <h4>Ajouter une article</h4>
                    <template x-if="articleM != null">
                        <form id="form-video" x-on:submit.prevent="sendForm()" class="row">
                            <div class="col-12 mb-3">
                                <div class="mb-2">
                                    <label for="title" class="form-label">Titre*</label>
                                    <input class="form-control" name="title" type="text" id="title" x-model="articleM['title']">
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="mb-2">
                                    <label for="description" class="form-label">Description*</label>
                                    <div class="form-control" name="description" type="text" id="description" x-text="articleM['description']" @keyup="article['description']=$event.target.innerHTML" @change="article['description']=$event.target.innerHTML"></div>
                                </div>
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
            </div>
        </section>
    </section>
</div>


<!-- Include stylesheet -->
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.8.0/highlight.min.js" integrity="sha512-rdhY3cbXURo13l/WU9VlaRyaIYeJ/KBakckXIvJNAQde8DgpOmE+eZf7ha4vdqVjTtwQt69bD2wH2LXob/LB7Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- 
Include the Quill library 
https://quilljs.com/docs/modules/toolbar/
-->
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

<script src="../libs/dataTable.js"></script>
<script src="../libs/FormValidation.js"></script>
<script src="../js/alpinejs/admin/articles.js"></script>
<?php
    require_once "../View/footer.php";
?>