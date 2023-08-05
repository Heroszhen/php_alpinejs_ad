document.addEventListener('alpine:init', () => {
    Alpine.data('adminphotos', () => ({
        allPhotos: [],
        elmindex: null,
        photoM: {
            url: "",
            base64: ""
        },
        dataTable: null,
        init() {
            isNotConnected();
            this.getAllPhotos();
            this.dataTable = new DataTable("tablePhotos", 4);
        },
        async getAllPhotos() {
            let res = await fetchGet("/admin/photos/photos", localStorage.getItem('token'));
            if (res["status"] === -1) window.location.href = "/";
            else if (res["status"] === 1) {
                this.allPhotos = res["data"];
                await wait(1);
                this.dataTable.setTotal(this.allPhotos.length);
            }
        },
        async inputFileHandler(e) {
            let file = e.target.files.item(0);
            if (file["type"].includes("image")) {
                this.photoM['base64'] = await readFile(file);
            }
        },
        switchUrl(action) {
            if (action === 1) this.photoM["base64"] = "";
            else this.photoM["url"] = "";
        },
        async sendForm() {
            if (this.photoM["url"] === "" && this.photoM["base64"] === "") return
            if (this.photoM["base64"] !== "") this.photoM["url"] = this.photoM["base64"];

            let res = await fetchPost("/admin/photos/photo", this.photoM, localStorage.getItem('token'));
            if (res["status"] === -1) window.location.href = "/";
            else if (res["status"] === 1) {
                this.allPhotos.push(res["data"]);
                this.resetPhotoM();
                alert("Enregistré");
                await wait(0.5);
                this.dataTable.setTotal(1);
            }
        },
        resetPhotoM() {
            this.photoM = {
                url: "",
                base64: ""
            };
        },
        async deletePhoto(index) {
            if (!window.confirm('Voulez-vous supprimer cette photo ?')) return;
            let res = await fetchDelete(`/admin/photos/photo/${this.allPhotos[index]['id']}`, localStorage.getItem('token'));
            if (res["status"] === -1) window.location.href = "/";
            else if (res["status"] === 1) {
                this.allPhotos.splice(index, 1);
                alert("Enregistré");
                await wait(0.5);
                this.dataTable.setTotal(-1);
            }
        }
    }));
});