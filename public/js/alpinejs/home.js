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
                if (currentScroll - 5 > documentHeight) {
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
        }
    }));
});