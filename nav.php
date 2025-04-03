<?php
session_start();

// Vérifier si l'utilisateur est connecté avant d'accéder à $_SESSION
$isLoggedIn = isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true;
?>
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

.dropdown p{
    height: 20px;
    width: 100%;
    margin: 0;
    padding: 0;
    color: grey;
    padding: 12px 16px;
    display: block;
    text-decoration: none;
    text-align: left;
    transition: 0.3s;
}

.dropdown-content a:hover {
    background-color: #444;
}

/* Style pour le modal */
.profile-modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.7);
    z-index: 1001;
    justify-content: center;
    align-items: center;
}

.profile-modal-content {
    background: #333;
    padding: 25px;
    border-radius: 8px;
    width: 90%;
    max-width: 400px;
    position: relative;
    color: white;
    text-align: center;
}

.profile-modal button {
    padding: 10px 20px;
    margin: 10px 5px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    background: #444;
    color: white;
    transition: 0.3s;
}

.profile-close-modal {
    position: absolute;
    right: 10px;
    top: 10px;
    font-size: 24px;
    cursor: pointer;
    color: #fff;
}

/* Style pour la prévisualisation */
#imagePreview {
    max-width: 200px;
    max-height: 200px;
    margin: 10px auto;
    display: none;
    border-radius: 5px;
}

/* Conteneur pour l'input file */
.file-input-container {
    margin: 15px 0;
}
</style>

<nav>
    <div class="nav-container">
        <ul class="nav-links">
            <li><a href="http://localhost/site-LOL/index.php">Accueil</a></li>
            <li><a href="http://localhost/site-LOL/champions/champions.php">Champions</a></li>
            <li><a href="http://localhost/site-LOL/builds_/builds.php">Builds</a></li>
        </ul>
        <div class="account">
            <div class="dropdown">
                <img src="http://localhost/site-LOL/img/profiles/<?php 
                    echo $isLoggedIn && isset($_SESSION['profile_picture']) 
                        ? htmlspecialchars($_SESSION['profile_picture']) 
                        : 'none.jpg'; 
                    ?>" alt="Compte" class="user-icon" onclick="toggleDropdown()">
                <div class="dropdown-content" id="dropdownMenu">
                    <?php if ($isLoggedIn) : ?>
                        <p>Bienvenue, <?php echo htmlspecialchars($_SESSION['username']); ?></p>
                        <a href="#" onclick="openModal(); return false;">Changer la photo de profil</a>
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

<!-- Modal pour le changement de photo -->
<div id="profileModal" class="profile-modal">
    <div class="profile-modal-content">
        <span class="profile-close-modal" onclick="closeModal()">&times;</span>
        <h2>Changer la photo de profil</h2>
        <form action="upload.php" method="POST" enctype="multipart/form-data">
            <div class="file-input-container">
                <input type="file" name="profile_picture" accept="image/*" required onchange="previewImage(this)">
            </div>
            <img id="imagePreview" src="#" alt="Prévisualisation">
            <div>
                <button type="submit" name="submit">Télécharger</button>
                <button type="button" onclick="closeModal()">Annuler</button>
            </div>
        </form>
    </div>
</div>

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

function openModal() {
    document.getElementById('profileModal').style.display = 'flex';
}

function closeModal() {
    document.getElementById('profileModal').style.display = 'none';
    document.getElementById('imagePreview').style.display = 'none';
    document.querySelector('input[name="profile_picture"]').value = '';
}

// Fermer le dropdown et le modal si on clique en dehors
window.onclick = function(event) {
    if (!event.target.matches('.user-icon')) {
        var dropdowns = document.getElementsByClassName("dropdown-content");
        for (var i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if (openDropdown.classList.contains('show')) {
                openDropdown.classList.remove('show');
            }
        }
    }

    let modal = document.getElementById('profileModal');
    if (event.target == modal) {
        closeModal();
    }
}

function previewImage(input) {
    const preview = document.getElementById('imagePreview');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
        }
        
        reader.readAsDataURL(input.files[0]);
    } else {
        preview.style.display = 'none';
    }
}
</script>
