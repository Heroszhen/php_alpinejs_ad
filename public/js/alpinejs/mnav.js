document.addEventListener('alpine:init', () => {
    Alpine.data('mnav', () => ({
        connected: false,
        profile: null,
        init() {
            let token = localStorage.getItem("token");
            if (token !== null && token !== "") {
                this.connected = true;
            }
            this.getProfile();
        },
        async getProfile() {
            let profile = localStorage.getItem("profile");
            if (profile !== null && profile !== "") {
                this.profile = JSON.parse(profile);
            } else if (this.connected === true) {
                let res = await fetchGet("/profile/profile", localStorage.getItem("token"))
                if (res["status"] === 1) {
                    profile = res["data"];
                    localStorage.setItem("profile", JSON.stringify(res["data"]));
                    location.reload();
                }
            }
        },
        getToken() {
            return this.$refs.urlMK.dataset.url + "/tailwindcss?token=" + localStorage.getItem("token");
        }
    }));
});