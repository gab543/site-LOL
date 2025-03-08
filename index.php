<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Champions de League of Legends</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
        }
        .search-bar {
            margin: 20px;
            padding: 10px;
            width: 50%;
            font-size: 16px;
        }
        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }
        .champion {
            margin: 10px;
            text-align: center;
            cursor: pointer;
        }
        .champion img {
            width: 120px;
            height: 120px;
            border-radius: 10px;
            transition: transform 0.2s;
        }
        .champion img:hover {
            transform: scale(1.1);
        }
        .champion-name {
            margin-top: 5px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <?php
    include("nav.php")
    ?>
    <input type="search" id="search" class="search-bar" placeholder="Rechercher un champion...">
    <div class="container" id="championContainer">
        <!-- Les champions seront ajoutés ici -->
    </div>
</body>
</html>