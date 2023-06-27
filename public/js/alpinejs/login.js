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
});