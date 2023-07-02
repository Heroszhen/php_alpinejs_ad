<?php
    require_once "../View/header.php";
?>

<section id="videos" class="pinterest under-mnav" x-data="videos">
    <div class="container pt-2 pb-3">
        <div class="row">
            <template x-for="(item, index) in videos">
                <article class="col-12 col-md-6 col-lg-4 mb-5">
                    <div class="wrap-video" @click="setElmindex(index)">
                        <div class="wrap-image">
                            <img :src="item['thumbnail']" alt="">
                        </div>
                        <h5 x-text="item['title']"></h5>
                    </div>
                </article>
            </template>
        </div>
    </div>
    <template x-if="elmindex != null">
        <section id="section-video">
            <section id="wrap-displayed-video">
                <template x-if="videos[elmindex] != null && ['1', '4', '5'].includes(videos[elmindex]['type'])">
                    <div class="wrap" :class="{'wrap-tiktok': videos[elmindex]['type']=='4'}" x-html="videos[elmindex]['url']"></div>
                </template>
                <template x-if="videos[elmindex] != null && videos[elmindex]['type'] == '3'">
                    <a class="wrap" :href="videos[elmindex]['url']" target="_blank">
                        <img :src="videos[elmindex]['thumbnail']" alt="">
                    </a>
                </template>
            </section>
            <section id="wrap-comments">
                <div>
                    <i class="bi bi-arrow-left close-video me-2" @click="setElmindex(null)">Retour</i>
                </div>
                <h3 x-text="videos[elmindex]['title']" class="mt-2"></h3>
            </section>
        </section>
    </template>
</section>

<script src="./js/alpinejs/home.js"></script>
<?php
    require_once "../View/footer.php";
?>