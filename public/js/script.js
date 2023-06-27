(function () {
    if (document.querySelector(".admin")) {
        document.getElementById("btn-admin-right-nav").addEventListener("click", (e) => {
            toggleAdminRightNav(1)
        })
        document.getElementById("btn-admin-right-nav2").addEventListener("click", (e) => {
            toggleAdminRightNav(0)
        })
    }

    deconnection();
})();

function toggleAdminRightNav(action) {
    let dom = document.getElementById("admin-right-nav");
    if (dom !== null) {
        if (action === 0) dom.classList.remove("opened");
        else if (action === 1) dom.classList.add("opened");
    }
}

function deconnection() {
    document.querySelectorAll(".logout").forEach((e) => {
        e.addEventListener("click", () => {
            console.log(e)
            localStorage.removeItem("token");
            localStorage.removeItem("profile");
            window.location.href = "/";
        })
    });
}
