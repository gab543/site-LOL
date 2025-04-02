<style>
body {
    font-family: Arial, sans-serif;
    padding: 20px;
    color: #bdbdbd;
    background-color: #2a2a2a;
}
nav {
    background-color: #222;
    padding: 15px 30px;
}

/* Conteneur principal pour aligner les éléments */
.nav-container {
    display: flex;
    align-items: center;
    justify-content: space-between;
}

/* Liste des liens */
.nav-links {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    justify-content: center;
    gap: 20px;
    width: 100%;
}

/* Liens de navigation */
.nav-links a {
    color: white;
    text-decoration: none;
    font-size: 18px;
    padding: 10px 15px;
    transition: 0.3s;
}

/* Effet au survol */
.nav-links a:hover {
    background-color: #444;
    border-radius: 5px;
}

/* Icône de compte alignée à droite */
.account {
    margin-left: auto; /* Pousse tout à droite */
    position: relative; /* Permet de positionner le dropdown */
}

/* Style de l'icône */
.user-icon {
    width: 40px;
    max-width: 40px;
    min-width: 40px;
    height: 40px;
    max-height: 40px;
    min-height: 40px;
    border-radius: 50%;
    cursor: pointer;
    transition: 0.3s;
}

/* Effet au survol */
.user-icon:hover {
    background-color: #444;
    border-radius: 50%;
}

/* Dropdown */
.dropdown {
    position: relative;
}

/* Contenu du dropdown */
.dropdown-content {
    display: none;
    position: absolute;
    top: 50px; /* Décale sous l’icône */
    right: 0;
    background-color: #333;
    min-width: 160px;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
    border-radius: 5px;
    overflow: hidden;
    z-index: 1000; /* Évite que le menu passe derrière */
}

/* Liens du dropdown */
.dropdown-content a {
    color: white;
    padding: 12px 16px;
    display: block;
    text-decoration: none;
    text-align: left;
    transition: 0.3s;
}

.dropdown-content a:hover {
    background-color: #444;
}

</style>
<nav>
    <div class="nav-container">
        <ul class="nav-links">
            <li><a href="http://localhost/site-LOL/index.php">Accueil</a></li>
            <li><a href="http://localhost/site-LOL/champions/champions.php">Champions</a></li>
            <li><a href="http://localhost/site-LOL/builds_/builds.php">Builds</a></li>
        </ul>

        <!-- Icône de compte tout à droite -->
        <div class="account">
            <div class="dropdown">
                <img src="http://localhost/site-LOL/img/profiles/none.jpg" alt="Compte" class="user-icon" onclick="toggleDropdown()">
                <div class="dropdown-content" id="dropdownMenu">
                    <?php SESSION_START(); ?>
                    <?php if (isset($_SESSION['username'])) : ?>
                        <p>Bienvenue, <?php echo htmlspecialchars($_SESSION['username']); ?></p>
                        <a href="javascript:void(0);" onclick="document.getElementById('upload-form').style.display='block'">Changer ma photo de profile</a>
                            <div id="upload-form" style="display:none;">
                                <h2>Changer la photo de profil</h2>
                                <form action="upload.php" method="POST" enctype="multipart/form-data">
                                    <input type="file" name="profile_picture" accept="image/*" required>
                                    <button type="submit" name="submit">Télécharger</button>
                                </form>
                                <button onclick="document.getElementById('upload-form').style.display='none'">Annuler</button>
                            </div>
                        <a href="http://localhost/site-LOL/connection/logout.php">Déconnexion</a>
                    <?php else : ?>
                        <a href="http://localhost/site-LOL/connection/register.php">Inscription</a>
                        <a href="http://localhost/site-LOL/connection/login.php">Connexion</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</nav>
<script>
    function toggleDropdown() {
        var menu = document.getElementById("dropdownMenu");
        menu.style.display = (menu.style.display === "block") ? "none" : "block";
    }

    // Fermer le menu si on clique ailleurs
    window.onclick = function(event) {
        if (!event.target.matches('.user-icon')) {
            var dropdowns = document.getElementsByClassName("dropdown-content");
            for (var i = 0; i < dropdowns.length; i++) {
                var openDropdown = dropdowns[i];
                if (openDropdown.style.display === "block") {
                    openDropdown.style.display = "none";
                }
            }
        }
    };
</script>
