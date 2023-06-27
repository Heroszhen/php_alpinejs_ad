document.addEventListener('alpine:init', () => {
    Alpine.data('adminusers', () => ({
        allUsers: [],
        displayedForm: false,
        userM: null,
        photoBase64: "",
        elmindex: null,
        init() {
            isNotConnected();
            this.getAllUsers();
        },
        async getAllUsers() {
            let res = await fetchGet("/admin/users", localStorage.getItem('token'));
            switch (res["status"]) {
                case -1:
                    window.location.href = "/";
                    break;
                case 0:
                    break;
                case 1:
                    this.allUsers = res["data"];
                    break;
                default:
            }
        },
        searchByKeywords(e) {
            let value = (e.target.value).toLowerCase();
            for (let entry of this.allUsers) {
                entry["filter"] = "false";
                for (let index in entry) {
                    if (["lastname", "firstname"].includes(index)) {
                        if (entry[index].toLowerCase().includes(value)) {
                            entry["filter"] = "";
                            break;
                        }
                    }
                }
            }
        },
        switchRights(e) {
            let checked = e.target.checked;
            let value = e.target.value;
            if (checked) {
                this.userM['roles'].push(value);
            } else {
                for (let index in this.userM['roles']) {
                    if (this.userM['roles'][index] === value) {
                        this.userM['roles'].splice(index, 1);
                        break;
                    }
                }
            }
        },
        async inputFileHandler(e) {
            let file = e.target.files.item(0);
            if (file["type"].includes("image")) {
                this.photoBase64 = await readFile(file);
            }
        },
        async sendForm() {
            if (this.photoBase64 !== "") this.userM["photo"] = this.photoBase64;
            if (this.userM["lastname"] !== "" && this.userM["firstname"] !== "" && this.userM["email"] !== "") {
                let res = await fetchPost("/admin/users/user", this.userM, localStorage.getItem('token'));
                if (res["status"] === -1) window.location.href = "/";
                else if (res["status"] === 1) {
                    if (this.elmindex === null) {
                        this.allUsers.push(res["data"]);
                        this.switchFormSection(0);
                        alert("Enregistré");
                    } else {
                        this.allUsers[this.elmindex] = res["data"];
                        alert("Enregistré");
                    }
                } else if (res["status"] === 2) {
                    alert(res["message"]);
                }
            }
        },
        getUserModel() {
            return {
                id: null,
                lastname: "",
                firstname: "",
                email: "",
                photo: "",
                roles: []
            }
        },
        switchFormSection(action, index = null) {
            if (action === 0) {

            }
            if (action === 1) {
                this.photoBase64 = "";
                this.userM = this.getUserModel();
                this.elmindex = index;
                if (index !== null) {
                    Object.assign(this.userM, this.allUsers[index]);
                }
            }
            this.displayedForm = action === 1 ? true : false;
        },
        async deleteuser(index) {
            if (!window.confirm("Voulez-vous supprimer cet utilisateur ?")) return;

            if (parseInt(this.allUsers[index]["id"]) === 1) {
                alert("Pas question !");
                return;
            }

            let res = await fetchDelete(`/admin/users/user/${this.allUsers[index]['id']}`, localStorage.getItem('token'));
            if (res["status"] === -1) window.location.href = "/";
            else if (res["status"] === 1) {
                this.allUsers.splice(index, 1);
            }
        }
    }));
});