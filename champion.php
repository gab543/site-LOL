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
            padding: 20px;
        }
        .champion-container {
            max-width: 600px;
            margin: auto;
            text-align: center;
        }
        .champion-image {
            width: 200px;
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <h1 id="champion-name"></h1>
    <div class="champion-container">
        <img id="champion-image" class="champion-image" src="" alt="">
        <p id="champion-title"></p>
        <p id="champion-lore"></p>
    </div>
    <a href="champions.php">← Retour aux champions</a>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const params = new URLSearchParams(window.location.search);
            const championName = params.get("name");
        if (!championName) {
            document.body.innerHTML = "<h2>Champion non trouvé</h2>";
        } else {
            fetch(`builds_/data/champion.json`)
                .then(response => response.json())
                    if (!championName) {
                        document.body.innerHTML = "<h2>Champion non trouvé</h2>";
                    return;
            }

            fetch("builds_/data/champion.json")
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
                    document.getElementById("champion-image").src = `images/champions_images/${champion.image.full}`;
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
