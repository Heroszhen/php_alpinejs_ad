<?php
    require_once "../View/header.php";
?>

<section id="home" class="pinterest under-mnav" x-data="home">
    <div class="container pt-2">
        <div class="row">
            <div class="col-12">
                <div class="wrap-photos" x-ref="wrap_photos">
                    <template x-for="(item, index) in photos">
                        <img :src="item['url']" alt="" class="d-none"  @dblclick="toggleBigImage(item['url'])">
                    </template>
                </div>
            </div>
        </div>
    </div>
    <template x-if="bigImage != ''">
        <section class="wrap-bigimage"  @dblclick="toggleBigImage('')">
            <div class="wrap-bigimage-container">
                <img id="bigImage" :src="bigImage" alt="" @dblclick="toggleBigImage('')">
            </div>
        </section>
    </template>
</section>

<link rel="stylesheet" type="text/css" href="/libs/magnifying/style.css">
<script src="./libs/magnifying/script.js"></script>
<script src="./libs/masonry.js"></script>
<script src="./js/alpinejs/home.js"></script>
<?php
    require_once "../View/footer.php";
?>