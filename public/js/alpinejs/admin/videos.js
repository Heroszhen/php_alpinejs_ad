class Video {
    id = null;
    user_id = null;
    user = null;
    type = "";
    url = "";
    thumbnail = "";
    title = "";
}

document.addEventListener('alpine:init', () => {
    Alpine.data('adminvideos', () => ({
        allVideos: [],
        elmindex: null,
        videoM: null,
        dataTable: null,
        typeReferences: {
            "iframe": '1',
            "video": "2",
            "url externe": '3',
            "tiktok": '4',
            "vidéo intégrée": '5'
        },
        displayedVideo: null,
        formValidation: null,
        init() {
            isNotConnected();
            this.getAllVideos();
            this.videoM = new Video();
            this.dataTable = new DataTable("tableVideos", 4);
            this.formValidation = new FormValidation("form-video");
        },
        async getAllVideos() {
            let res = await fetchGet("/admin/videos/videos", localStorage.getItem('token'));
            if (res["status"] === -1) window.location.href = "/";
            else if (res["status"] === 1) {
                this.allVideos = res["data"];
                await wait(0.5);
                this.dataTable.setTotal(this.allVideos.length);
            }
        },
        async inputFileHandler(e) {
            let file = e.target.files.item(0);
            if (file["type"].includes("image")) {
                this.videoM['thumbnail'] = await readFile(file);
            }
        },
        setValidators() {
            this.formValidation = new FormValidation("form-video");
            if (this.videoM !== null) {
                if (this.videoM["id"] === null) {
                    this.formValidation.addValidators([
                        new RequiredValidator("title", "Le titre est obligatoire"),
                        new RequiredValidator("url", "L'url est obligatoire"),
                        new RequiredValidator("type", "Le type est obligatoire"),
                        new RequiredValidator("thumbnail", "La photo est obligatoire")
                    ]);
                } else {
                    this.formValidation.addValidators([
                        new RequiredValidator("title", "Le titre est obligatoire"),
                        new RequiredValidator("url", "L'url est obligatoire"),
                        new RequiredValidator("type", "Le type est obligatoire")
                    ]);
                }
            }
        },
        async sendForm() {
            this.setValidators();
            this.formValidation.check();
            if (this.formValidation.checked === true) {
                if (this.videoM["id"] === null) {
                    let res = await fetchPost("/admin/videos/video", this.videoM, localStorage.getItem('token'));
                    if (res["status"] === -1) window.location.href = "/";
                    else if (res["status"] === 1) {
                        this.allVideos.push(res["data"]);
                        this.resetForm();
                        await wait(0.5);
                        this.dataTable.setTotal(1);
                        alert("Enregistré")
                    }
                } else {
                    let res = await fetchPost(`/admin/videos/video/${this.allVideos[this.elmindex]["id"]}`, this.videoM, localStorage.getItem('token'));
                    if (res["status"] === -1) window.location.href = "/";
                    else if (res["status"] === 1) {
                        this.allVideos[this.elmindex] = res["data"];
                        alert("Enregistré")
                    }
                }
            }
        },
        resetForm() {
            this.videoM = new Video();
            this.elmindex = null;
            this.$refs.inputFile.value = null;
        },
        async deleteVideo(index) {
            if (!window.confirm("Voulez-vous supprimer cette vidéo ?")) return;
            let res = await fetchDelete(`/admin/videos/video/${this.allVideos[index]['id']}`, localStorage.getItem('token'));
            if (res["status"] === -1) window.location.href = "/";
            else if (res["status"] === 1) {
                this.allVideos.splice(index, 1);
                alert("Enregistré");
                await wait(0.5);
                this.dataTable.setTotal(1);
            }
        },
        setVideoM(index) {
            this.elmindex = index;
            Object.assign(this.videoM, this.allVideos[index]);
        },
        getType(number) {
            switch (number) {
                case '1':
                    return "iframe";
                case '2':
                    return "video";
                case '3':
                    return "url externe";
                case '4':
                    return "TikTok";
                case '5':
                    return "Vidéo intégrée";
                default:
            }
        },
        sortVideos(e) {
            if (this.allVideos.length > 0) {
                let keywords = e.target.value.toLowerCase();
                let tmp = [];
                let tmp2 = [];
                let checked;
                for (let entry of this.allVideos) {
                    checked = false;
                    for (let index in entry) {
                        if (['id', 'title'].includes(index)) {
                            if (entry[index].toLowerCase().includes(keywords)) {
                                checked = true;
                                break;
                            }
                        }
                        if (index === "type") {
                            if (this.typeReferences[keywords] === entry[index]) {
                                checked = true;
                                break;
                            }
                        }
                    }
                    if (checked) tmp.push(entry);
                    else tmp2.push(entry);
                }
                this.allVideos = tmp.concat(tmp2);
                this.dataTable.setTotal(0);
            }
        },
        async setDisplayedVideo(video = null) {
            if (video === null) {
                this.displayedVideo = video
            } else {
                if (video["type"] === '3') {
                    window.open(video['url'], '_blank');
                    return;
                }
                else this.displayedVideo = video;

                await wait(1);
                this.resetVideo();
                window.addEventListener('resize', async (e) => {
                    if (!['4', '5'].includes(this.displayedVideo["type"])) this.resetVideo();
                });
            }
        },
        resetVideo() {
            let dom = document.querySelector("#section-video iframe")
            dom.style.height = dom.clientWidth / 1.77 + "px";
        }
    }));
});