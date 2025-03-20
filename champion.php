<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du Champion</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            background: #FFF;
            background-repeat: no-repeat;
            background-size: cover;
            margin: 0;
            color: white;
        }
        .champion-image {
            width: 100vw;
            height: 100vh;
            background-size: cover;
            background-position: center;
            position: relative;
            display: flex;
            align-items: center; /* Centre verticalement */
        }

        .champion-image::after {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to right, rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0)); /* Dégradé noir à gauche */
        }

        .champion-info {
            position: absolute; /* Positionne le texte au-dessus de l'image */
            z-index: 1; /* Place le texte au-dessus de l'image */
            width: 50%; /* Largeur de 50% de la fenêtre */
            height: 100%;
            text-align: center;
            align-self: center;
            color: white;
            padding: 20px;
        }
        .champion-info--text {
            margin: 0 auto; /* Centre horizontalement */
            max-width: 50%;
            color: white;
        }   
        
        .return{
            padding: 10px;
            position: fixed;
            bottom: 10%;
            height: 40px;
            background: white;
            border-radius: 10px;
        }
        a{
            text-align: center;
            justify-self: center;
            color: black;
            text-decoration: none;
        }
        #champion-title{
            font-size: 20px;
            font-weight: bold;
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
            fetch("data/champion.json")
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
                    document.getElementById("champion-image").style.backgroundImage = `url("img/champion/centered/${champion.id}_0.jpg")`;
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
