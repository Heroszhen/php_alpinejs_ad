class Masonry {
    numberMargin = 0;
    elmWidth = 0;
    constructor(wrap, number, margin) {
        this.wrap = wrap;
        this.number = number;
        this.margin = margin;
    }

    run() {
        return new Promise(async (resolve, reject) => {
            this.wrap.style.display = "flex !important";
            this.wrap.style.flexWrap = "wrap";
            this.wrap.style.position = "relative";
            let widths = [];
            let heights = [];
            if (this.number === 1) {
                this.elmWidth = this.wrap.clientWidth;
                heights[0] = 0;
            } else {
                this.numberMargin = this.number - 1;
                this.elmWidth = (this.wrap.clientWidth - this.numberMargin * this.margin) / this.number;
                for (let i = 0; i < this.number; i++) {
                    if (i === 0) widths[i] = 0;
                    else widths[i] = widths[i - 1] + this.elmWidth + this.margin;
                }
                for (let i = 0; i < this.number; i++) {
                    heights[i] = 0;
                }
            }

            let children = this.wrap.childNodes;
            let index;
            let realHeight;
            children.forEach(async (item) => {
                const [imgWidth, imgHeight] = await this.#getImageSize(item.src);
                item.style.display = "block";
                item.style.position = "absolute";
                item.style.width = this.elmWidth + "px";
                realHeight = this.elmWidth / (imgWidth / imgHeight);
                item.style.height = realHeight + "px";
                index = this.#getIndexMinColumn(heights);
                item.style.left = widths[index] + "px";
                item.style.top = heights[index] + "px";
                heights[index] += realHeight + this.margin;
                item.classList.remove("d-none");

                this.wrap.style.height = heights[index] + 50 + "px";
            });


            resolve(1);
        });
    }

    #getImageSize(url) {
        return new Promise((resolve, reject) => {
            let img = new Image();
            img.onload = () => {
                resolve([img.width, img.height]);
            }
            img.src = url;
        });
    }

    #getIndexMinColumn(tab) {
        let minimum = Math.min(...tab);

        return tab.indexOf(minimum);
    }

}