document.addEventListener('alpine:init', () => {
    Alpine.data('home', () => ({
        id: 0,
        photos: [],
        columns: 5,
        locked: false,
        bigImage: "",
        init() {
            this.getPhotos();
            window.addEventListener("resize", (e) => {
                debounce(this.resetColumns, 1)();
            });
            document.addEventListener('scroll', async (e) => {
                let documentHeight = document.body.scrollHeight;
                let currentScroll = e.target.scrollingElement.scrollTop + window.innerHeight;
                if (currentScroll + 5 > documentHeight) {
                    console.log('You are at the bottom!', this.locked)
                    if (this.locked === false) {
                        this.locked = true;
                        this.id--;
                        if (this.id > 0) await this.getPhotos();
                        else this.locked = false;
                    }
                }
            })
        },
        async getPhotos() {
            this.locked = true;
            let res = await fetchGet(`/home/get-photos/${this.id}`);
            if (res["status"] === 1) {
                this.photos = this.photos.concat(res["data"]);
                this.id = parseInt(this.photos[this.photos.length - 1]["id"]);
                await this.resetColumns();
                this.locked = false;
            }
            this.locked = false;
        },
        resetColumns: async function () {
            let width = window.innerWidth;
            let columns;
            if (width > 992) {
                columns = 5;
            } else if (576 < width && width <= 992) {
                columns = 3;
            } else {
                columns = 2;
            }
            this.columns = columns;

            await wait(1);
            let masonry = new Masonry(document.querySelector(".wrap-photos"), this.columns, 16);
            await masonry.run();
        },
        async toggleBigImage(url = "") {
            this.bigImage = url;
            if (url === "") {

            } else {
                await wait(0.5);
                magnify("bigImage", 3);
            }
        }
    }));

    Alpine.data('videos', () => ({
        id: 0,
        videos: [],
        locked: false,
        elmindex: null,
        init() {
            this.getVideos();

            document.addEventListener('scroll', async (e) => {
                let documentHeight = document.body.scrollHeight;
                let currentScroll = e.target.scrollingElement.scrollTop + window.innerHeight;
                if (currentScroll + 5 > documentHeight) {
                    console.log('You are at the bottom!', this.locked)
                    if (this.locked === false) {
                        this.locked = true;
                        this.id--;
                        if (this.id > 0) await this.getVideos();
                        else this.locked = false;
                    }
                }
            })

            window.addEventListener('resize', async (e) => {
                debounce(this.resetWrapsImage, 1)();
                debounce(this.resetVideo, 0.1)();
            });
        },
        async getVideos() {
            this.locked = true;
            let res = await fetchGet(`/home/get-videos/${this.id}`);
            if (res["status"] === 1) {
                this.videos = this.videos.concat(res["data"]);
                this.id = parseInt(this.videos[this.videos.length - 1]["id"]);
                await wait(0.1);
                this.resetWrapsImage();
                this.locked = false;
            }
            this.locked = false;
        },
        resetWrapsImage: function () {
            document.querySelectorAll(".wrap-image").forEach(item => {
                item.style.height = item.clientWidth / 1.8 + "px";
            })
        },
        async setElmindex(index) {
            this.elmindex = index;
            if (index === null) {
                this.locked = false;
            } else {
                this.locked = true;
                await wait(0.1);
                this.resetVideo();
            }
        },
        resetVideo: function () {
            if (this.elmindex !== null && !['4', '5'].includes(this.videos[this.elmindex]["type"])) {
                let dom = document.querySelector("#wrap-displayed-video iframe")
                resetDom(dom);

                dom = document.querySelector("#wrap-displayed-video video");
                resetDom(dom);
            }
            function resetDom(dom) {
                if (dom !== null) {
                    dom.style.height = dom.clientWidth / 1.77 + "px";
                }
            }
        }
    }));
});