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
        .champion-container {
            max-width: 600px;
            margin: auto;
            text-align: center; 
        }
        .champion-image {
            color: black;
            border: 0px solid black;
            background: linear-gradient(to right, rgba(255, 255, 255, 0), rgb(0, 0, 0));
            width: 100vw;
            height: 100vh;
            repeat: no-repeat;
        }
    </style>
</head>
<body id="body">
    <img id="champion-image" class="champion-image" src="" alt="">
    <div class="champion-container">
        <h1 id="champion-name"></h1>
        <p id="champion-title"></p>
        <p id="champion-lore"></p>
        <a href="champions.php">← Retour aux champions</a>
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
                    document.getElementById("body").style.backgroundImage = `url("img/champion/centered/${champion.id}_0.jpg")`;
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
