<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du Champion</title>
    <style>
        /* Style de base */
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            color: white;
            background: #111; /* Fond sombre général */
        }

        .champion-image {
            width: 100%;
            height: 100vh;
            background-size: cover;
            background-position: center;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.3s ease-in-out;
        }

        .champion-image::after {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to right, rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0)); /* Dégradé sombre */
        }

        .champion-info {
            position: absolute;
            z-index: 1;
            color: white;
            text-align: left;
            margin: 30px;
            width: 50%; /* 50% de la largeur */
            height: 100%;
            background: linear-gradient(to right, rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0)); /* Dégradé comme fond */
            border-radius: 10px;
            
            animation: slideUp 0.5s ease-out forwards;
        }

        @keyframes slideUp {
            0% {
                transform: translateY(100px);
            }
            100% {
                transform: translateY(0);
            }
        }

        .champion-info h1 {
            font-size: 3rem;
            margin-bottom: 10px;
            font-weight: bold;
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.7);
        }

        .champion-info p {
            font-size: 1.1rem;
            line-height: 1.5;
            margin-bottom: 20px;
            text-align: justify;
        }

        .return {
            padding: 10px 20px;
            margin-top: 20px;
            background: white; 
            color: black;
            border-radius: 5px;
            font-weight: bold;
            transition: background 0.3s ease;
        }

        .return:hover {
            background: grey; /* Animation hover */
        }

        a {
            color: black;
            text-decoration: none;
        }

        /* Pour un meilleur affichage sur mobile */
        @media (max-width: 768px) {
            .champion-info {
                width: 80%;
            }

            .champion-info h1 {
                font-size: 2rem;
            }

            .champion-info p {
                font-size: 1rem;
            }
        }
    </style>
</head>
<body id="body">
    <div id="champion-image" class="champion-image">
        <img id="champion-image" class="champion-image" src="" alt="">
        <div class="champion-info">
            <div class="champion-info--text" >
                <h1 id="champion-name"></h1>
                <p id="champion-title"></p>
                <p id="champion-lore"></p>
                <div class="return" >
                    <a href="champions.php">← Retour aux champions</a>
                </div>               
            </div>
        </div>
    </div>
    
    

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const params = new URLSearchParams(window.location.search);
            const championName = params.get("name");
        if (!championName) {
            document.body.innerHTML = "<h2>Champion non trouvé</h2>";
        } 
        else {
            fetch("../data/champion.json")
                .then(response => {
                    if (!response.ok) {
                        throw new Error("Erreur lors du chargement du fichier JSON");
                    }
                    return response.json();
                })
                .then(data => {
                    const champion = data.data[championName];

                    if (!champion) {
                        document.body.innerHTML = `<h2>Champion "${championName}" non trouvé</h2>`;
                        return;
                    }

                    document.getElementById("champion-name").textContent = champion.name;
                    document.getElementById("champion-image").style.backgroundImage = `url("../img/champion/centered/${champion.id}_0.jpg")`;
                    document.getElementById("champion-title").textContent = champion.title;
                    document.getElementById("champion-lore").textContent = champion.blurb;
                })
                .catch(error => {
                    console.error("Erreur lors du chargement du champion :", error);
                    document.body.innerHTML = "<h2>Erreur : Impossible de charger ce champion.</h2>";
                });
            }
        });
    </script>

</body>
</html>
