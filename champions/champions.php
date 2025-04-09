<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style--champions.css">
    <title>Champions de League of Legends</title>
</head>
<body>
    <?php
    include("../nav.php")
    ?>
    <input type="search" id="search" class="search-bar" placeholder="Rechercher un champion...">
    <div class="container" id="championContainer">
        
    </div>
    <script>
        fetch("../data/champion.json")
            .then(response => response.json())
            .then(data => {
                // L'objet JSON stocke les champions sous "data"
                const champions = data.data;

                // Sélection de l'endroit où afficher les champions
                const container = document.getElementById("championContainer");

                // Parcours des champions et création des éléments HTML
                Object.values(champions).forEach(champion => {
                    const champDiv = document.createElement("div");
                    champDiv.classList.add("champion");

                    champDiv.innerHTML = `
                        <a href="champion.php?name=${champion.id}">
                        <img src="../img/champion/tiles/${champion.id}_0.jpg" 
                            alt="${champion.name}" class="champion-img">
                        <p style="text-decoration: none">${champion.name}</p></a>
                    `;

                // Ajoute l'élément au container
                container.appendChild(champDiv);
                });
            })
            .catch(error => console.error("Erreur lors du chargement des champions :", error));
            document.getElementById("search").addEventListener("input", function() {
                let searchValue = this.value.toLowerCase();
                let champions = document.querySelectorAll(".champion");

                champions.forEach(champion => {
                    let championName = champion.innerText.toLowerCase();
                    if (championName.includes(searchValue)) {
                        champion.style.display = "block";
                    } else {
                        champion.style.display = "none";
                    }
                });
            });
    </script>
</body>
</html>
