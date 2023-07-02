<nav id="m-nav" x-data="mnav">
    <div class="wrap">
        <div class="wrap-icon"></div>
        <div class="menu">
            <a href="/" class="<?= $_SERVER["REQUEST_URI"] === '/' ? 'active' : '' ?>">Accueil</a>
        </div>
        <div class="menu">
            <a  class="<?= $_SERVER["REQUEST_URI"] === '/news' ? 'active' : '' ?>">Actualités</a>
        </div>
        <div class="menu">
            <a href="/videos" class="<?= $_SERVER["REQUEST_URI"] === '/videos' ? 'active' : '' ?>">Vidéos</a>
        </div>
        <template x-if="connected == true && profile != null">
            <div class="menu">
                <a class="<?= $_SERVER["REQUEST_URI"] === '/profile' ? 'active' : '' ?>">Profil</a>
            </div>
        </template>
        <template x-if="connected == true && profile != null && profile['roles'].includes('role_admin')">
            <div class="menu">
                <a href="/admin/photos">Admin</a>
            </div>
        </template>
        <template x-if="connected == false">
            <div class="menu">
                <a href="/login">Connexion</a>
            </div>
        </template>
        <template x-if="connected == false">
            <div class="menu">
                <a href="/">Inscription</a>
            </div>
        </template>
        <template x-if="connected == true">
            <div class="menu">
                <a class="pointer logout">Déconnexion</a>
            </div>
        </template>
        <template x-if="connected == true && profile != null">
            <div class="menu d-flex align-items-center">
                <img :src="profile['photo']" id="profile-photo">
                <div class="ms-2 fs-3">Bienvenue <span x-text="profile['firstname']"></span></div>
            </div>
        </template>
    </div>
</nav>

