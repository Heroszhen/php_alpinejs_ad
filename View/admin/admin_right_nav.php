<section id="admin-right-nav">
    <div>
        <i class="bi bi-arrow-left" id="btn-admin-right-nav2"></i>
    </div>
    <a class="menu" href="/">
        Accueil
    </a>
    <a class="menu <?= $_SERVER["REQUEST_URI"] === '/admin/utilisateurs' ? 'active' : '' ?>" href="/admin/utilisateurs">
        Utilisateur
    </a>
    <a class="menu <?= $_SERVER["REQUEST_URI"] === '/admin/photos' ? 'active' : '' ?>" href="/admin/photos">
        Photo
    </a>
    <a class="menu" href="/admin/articles">
        Article
    </a>
    <a class="menu <?= $_SERVER["REQUEST_URI"] === '/admin/videos' ? 'active' : '' ?>" href="/admin/videos">
        Video
    </a>
    <div class="menu logout">
        Déconnexion
    </div>
</section>