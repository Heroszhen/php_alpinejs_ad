document.addEventListener('alpine:init', () => {
    Alpine.data('login', () => ({
        loginM: {
            email: "",
            password: ""
        },
        init() {
            isConnected();
        },
        async sendForm() {
            if (this.loginM["email"] !== "" && this.loginM["password"] !== "") {
                let res = await fetchPost(
                    "login",
                    this.loginM
                );
                if (res["status"] === 1) {
                    localStorage.setItem("token", res["data"]["token"]);
                    window.location.href = res["data"]["route"];
                } else {
                    alert("Erreur");
                }
            } else {
                alert("Veuillez remplir les champs obligatoires");
            }
        }
    }));

    Alpine.data('logup', () => ({
        userM: null,
        formValidation: null,
        init() {
            isConnected();
            this.userM = new User();
            this.formValidation = new FormValidation("form-logup");
            this.formValidation.addValidators([
                new RequiredValidator("lastname", "Le nom est obligatoire"),
                new RequiredValidator("firstname", "Le prénom est obligatoire"),
                new RequiredValidator("email", "Le mail est obligatoire"),
                new EmailValidator("email", "Le mail n'est pas au format correct"),
                new RequiredValidator("password", "Le mot de passe est obligatoire"),
                new MinLengthValidator("password", 8, "Le mot de passe doit contenir au moins 8 caractères")
            ]);
        },
        async sendForm() {
            this.formValidation.check();
            if (this.formValidation.checked === true) {
                let res = await fetchPost(
                    "logup",
                    this.userM
                );
                if (res["status"] === 1) {
                    alert("Votre inscription a été faite avec succès, vous allez être redirigé vers la page d'accueil")
                    window.location.href = "/";
                } else if (res["status"] === 2) {
                    alert("Il existe un utilisateur avec ce mail");
                } else {
                    alert("Erreur");
                }
            }
        }
    }));
});