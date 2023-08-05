document.addEventListener('alpine:init', () => {
    Alpine.data('profile', () => ({
        section: 1,
        userM: null,
        formValidation: null,
        cropper: null,
        init() {
            isNotConnected();
            this.switchSection(1);
        },
        async switchSection(section) {
            if (section === 1) {
                this.userM = new User();
                this.formValidation = new FormValidation("form-logup");
                this.formValidation.addValidators([
                    new RequiredValidator("lastname", "Le nom est obligatoire"),
                    new RequiredValidator("firstname", "Le prénom est obligatoire"),
                    new RequiredValidator("email", "Le mail est obligatoire"),
                    new EmailValidator("email", "Le mail n'est pas au format correct"),
                ]);

                let res = await fetchGet("/profile/user", localStorage.getItem("token"))
                if (res["status"] === 1) {
                    Object.assign(this.userM, res["data"]);
                    if (this.userM['photo'] !== '') this.setCropperjs();
                } else {
                    alert("Erreur");
                    window.location.href = "/";
                }
            }

            if (section === 2) {
                this.userM = new User();
            }

            if (section === 3) {

            }
            this.section = section;
        },
        async setCropperjs() {
            await wait(0.5);
            this.cropper = new Cropper(this.$refs.cropperImage, {
                aspectRatio: 9 / 9,
                autoCrop: true,
                viewMode: 2,
            });
        },
        async handleInputFile(e) {
            let file = e.target.files.item(0);
            if (file.type.includes("image")) {
                this.userM['photo'] = await readFile(file);
                this.setCropperjs();
            }
        },
        async croppeImage() {
            if (this.cropper.ready === true) this.userM["photo"] = this.cropper.getCroppedCanvas().toDataURL('image/jpeg');
        },
        async saveUser() {
            let res = await fetchPost("/profile/user", this.userM, localStorage.getItem("token"))
            if (res["status"] === 1) {
                localStorage.removeItem("profile");
                alert("Enregistrer");
            } else if (res["status"] === 2) {
                alert("Il existe un autre utilisateur avec ce mail");
            } else {
                alert("Erreur");
                window.location.href = "/";
            }
        },
    }))
})