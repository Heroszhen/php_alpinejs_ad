<?php
    require_once "../View/header.php";
?>

<section id="home" class="pinterest" x-data="home">
    <div class="container mt-3">
        <div class="row">
            <div class="col-12 under-mnav">
                <div class="wrap-photos" x-ref="wrap_photos">
                    <template x-for="(item, index) in photos">
                        <img :src="item['url']" alt="" class="d-none">
                    </template>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="./libs/masonry.js"></script>
<script src="./js/alpinejs/home.js"></script>
<?php
    require_once "../View/footer.php";
?>