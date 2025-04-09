<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index-style.css">
    <title>League of Legends</title>
</head>
<body>
    <?php
    include("nav.php")
    ?>
    <h1>Bienvenue sur League Helper</h1>
    <h2>Votre assistant pour League of Legends</h2>
    <button class="button" id="champ-list" type="button" href="champions/champions.php">liste des champions</button>
    <button class="button" id="builds-list" type="button" href="builds_/builds.php">liste des items et des sorts d'invocateurs</button>
</body>
<script>
    document.querySelector("#champ-list").addEventListener("click", () => {
            window.location.href = "champions/champions.php";
        });
    document.querySelector("#builds-list").addEventListener("click", () => {
            window.location.href = "builds_/builds.php";
        });
</script>
</html>