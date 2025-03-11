<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Créer un Build - LoL</title>
</head>

<body>
    <h1>Créer un Build</h1>
    <form id="build-form">
        <!-- Sélection du champion -->
        <label for="champion">Choisir un champion :</label>
        <select id="champion" required>
            <option value="">Sélectionnez un champion</option>
        </select>-

        <!-- Grille pour la sélection des 6 items -->
        <label>Choisir 6 items :</label>
        <div class="item-grid" id="item-grid">
            <div class="item-box" data-index="0">+</div>
            <div class="item-box" data-index="1">+</div>
            <div class="item-box" data-index="2">+</div>
            <div class="item-box" data-index="3">+</div>
            <div class="item-box" data-index="4">+</div>
            <div class="item-box" data-index="5">+</div>
        </div>

        <button type="submit" style="margin-top:20px; padding:10px 20px; font-size:16px;">Enregistrer le Build</button>
    </form>
    
    <h1>Sorts d'Invocateur</h1>
    <div id="summoner-spells" class="container"></div>

    <h1>Runes</h1>
    <div id="runes" class="container"></div>

    <h2>Builds enregistrés</h2>
    <div id="builds-container"></div>

    <!-- Modal pour la sélection d'item -->
    <div id="modal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Choisir un item</h2>
                <span class="close-modal">&times;</span>
            </div>
            <input type="text" id="modal-search" class="search-bar" placeholder="Rechercher un item...">
            <div class="item-list" id="modal-item-list">
                <!-- La liste des items sera insérée ici -->
            </div>
        </div>
    </div>

    <script src="builds.js"></script>
</body>
</html>