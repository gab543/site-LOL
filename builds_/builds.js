document.addEventListener("DOMContentLoaded", () => {
    console.log("Script chargé !");
    const itemBoxes = document.querySelectorAll(".item-box");
    const modal = document.getElementById("modal");
    const modalItemList = document.getElementById("modal-item-list");
    const modalSearch = document.getElementById("modal-search");
    const closeModalBtn = document.querySelector(".close-modal");
    const spellsContainer = document.getElementById("summoner-spells");
    const runesContainer = document.getElementById("runes");
    
    const item_images = "localhost/site-LOL/items_images";
    const item_json = "localhost/site-LOL/data/item.json";
    const summoner_images = "localhost/site-LOL/summoner_images";
    const runes_images = "localhost/site-LOL/runes_images";
    const summoner_json = "localhost/site-LOL/data/summoner.json";
    const runes_json = "localhost/site-LOL/data/runesReforged.json";
    let itemsData = {};
    let selectedBoxIndex = null;

    // Ajouter l'événement de clic sur chaque case d'item
    itemBoxes.forEach((box) => {
        box.addEventListener("click", function () {
            selectedBoxIndex = this.dataset.index;
            openModal();
        });
    });

    // Fonction pour ouvrir le modal
    function openModal() {
        modal.style.display = "block";
        modalSearch.value = "";
        populateModalItems(itemsData);
    }

    // Fermer le modal
    closeModalBtn.addEventListener("click", () => {
        modal.style.display = "none";
    });

    window.addEventListener("click", (e) => {
        if (e.target === modal) {
            modal.style.display = "none";
        }
    });

<<<<<<< Updated upstream
<<<<<<< Updated upstream
<<<<<<< Updated upstream
    // Charger la liste des items depuis l'API Riot
    fetch("data/item.json")
=======
    // Charger la liste des items depuis ton fichier local
    fetch($item_json)
>>>>>>> Stashed changes
=======
    // Charger la liste des items depuis ton fichier local
    fetch($item_json)
>>>>>>> Stashed changes
=======
    // Charger la liste des items depuis ton fichier local
    fetch($item_json)
>>>>>>> Stashed changes
        .then((response) => response.json())
        .then((data) => {
            itemsData = data.data;
            populateModalItems(itemsData);
        });

    // Afficher la liste des items dans le modal
    function populateModalItems(items) {
<<<<<<< Updated upstream
<<<<<<< Updated upstream
<<<<<<< Updated upstream
        modalItemList.innerHTML = ""; // On vide la liste avant de remplir
    
        const seenItems = new Set(); // Pour éviter les doublons
    
        for (const itemId in items) {
            const item = items[itemId];
    
            // Vérifier si l'objet est achetable
=======
=======
>>>>>>> Stashed changes
=======
>>>>>>> Stashed changes
        modalItemList.innerHTML = ""; 
        for (const itemId in items) {
            const item = items[itemId];

<<<<<<< Updated upstream
<<<<<<< Updated upstream
>>>>>>> Stashed changes
=======
>>>>>>> Stashed changes
=======
>>>>>>> Stashed changes
            if (!item.gold.purchasable) continue;
    
            // Ignorer les items dont l'ID commence par "22"
            if (itemId.startsWith("22")) continue;

<<<<<<< Updated upstream
<<<<<<< Updated upstream
<<<<<<< Updated upstream
            if ("requiredChampion" in item) continue; 
    
            // Vérifier si l'item a déjà été ajouté
            if (seenItems.has(itemId)) continue;
            seenItems.add(itemId);
    
            // ✅ Vérifier si les tags contiennent "Vision" ET "Jungle"
            if (!item.tags.includes("Vision") || !item.tags.includes("Jungle")) continue;
    
            // Créer un élément pour l'item
            const itemDiv = document.createElement("div");
            itemDiv.dataset.itemId = itemId;
            itemDiv.innerHTML = `
                <img src="items_images/${itemId}.png" alt="${item.name}">
                <br class="item-name">${item.name}
=======
            const itemDiv = document.createElement("div");
            itemDiv.dataset.itemId = itemId;
            itemDiv.innerHTML = `
                <img src="${item_images}/${itemId}.png" alt="${item.name}">
                <br>${item.name}
>>>>>>> Stashed changes
=======
            const itemDiv = document.createElement("div");
            itemDiv.dataset.itemId = itemId;
            itemDiv.innerHTML = `
                <img src="${item_images}/${itemId}.png" alt="${item.name}">
                <br>${item.name}
>>>>>>> Stashed changes
=======
            const itemDiv = document.createElement("div");
            itemDiv.dataset.itemId = itemId;
            itemDiv.innerHTML = `
                <img src="${item_images}/${itemId}.png" alt="${item.name}">
                <br>${item.name}
>>>>>>> Stashed changes
            `;
    
            modalItemList.appendChild(itemDiv);
        }
    }
    
    

    // Sélection d'un item
    modalItemList.addEventListener("click", (e) => {
        let target = e.target;
        while (target && !target.dataset.itemId) {
            target = target.parentNode;
        }
        if (target && target.dataset.itemId) {
            const selectedItemId = target.dataset.itemId;
<<<<<<< Updated upstream
<<<<<<< Updated upstream
<<<<<<< Updated upstream
            const selectedBox = document.querySelector(
                `.item-box[data-index="${selectedBoxIndex}"]`
            );
            selectedBox.innerHTML = `<img src="items_images/${selectedItemId}.png" alt="Item">`;
=======
            const selectedBox = document.querySelector(`.item-box[data-index="${selectedBoxIndex}"]`);
            selectedBox.innerHTML = `<img src="item_images/${selectedItemId}.png" alt="Item">`;
>>>>>>> Stashed changes
=======
            const selectedBox = document.querySelector(`.item-box[data-index="${selectedBoxIndex}"]`);
            selectedBox.innerHTML = `<img src="item_images/${selectedItemId}.png" alt="Item">`;
>>>>>>> Stashed changes
=======
            const selectedBox = document.querySelector(`.item-box[data-index="${selectedBoxIndex}"]`);
            selectedBox.innerHTML = `<img src="item_images/${selectedItemId}.png" alt="Item">`;
>>>>>>> Stashed changes
            selectedBox.dataset.itemId = selectedItemId;
            modal.style.display = "none";
        }
    });

    // 🔥 Récupération des Sorts d'Invocateur
    fetch("data/summoner.json")
        .then(response => response.json())
        .then((data) => {
            const spells = data.data;
            for (const spellKey in spells) {
                const spell = spells[spellKey];
                const spellCard = document.createElement("div");
                spellCard.classList.add("card");

<<<<<<< Updated upstream
<<<<<<< Updated upstream
<<<<<<< Updated upstream
    modalItemList.addEventListener("mouseover", (e) => {
        let target = e.target;
        while (target && target.dataset.itemId !== undefined) {
            target = target.parentNode; // Remonter jusqu'à l'élément qui contient l'ID
        }
        if (target && target.dataset.itemId) {
            const itemId = target.dataset.itemId;
            const itemData = itemsData[itemId];
            const itemTooltip = document.getElementById("item-tooltip");
            itemTooltip.innerHTML = `
                    <h3>${itemData.name}</h3>
                    <p>${itemData.description}</p>
                `;
            itemTooltip.style.display = "block";
        }
        
    });       

            // 🔥 Récupération des Sorts d'Invocateur
        fetch(
            "data/summoner.json"
        )
            .then(response => {
            console.log("Réponse API:", response);
            return response.json();
            })
            .then((data) => {
                console.log("Summoner Spells Data:", data);
                const spells = data.data;
                for (const spellKey in spells) {
                    const spell = spells[spellKey];
                    const spellCard = document.createElement("div");
                    spellCard.classList.add("card");

                    spellCard.innerHTML = `
                    <img src="summoners_images/${spellKey}.png" alt="${spell.name}">
=======
                spellCard.innerHTML = `
                    <img src="summoner_images/${spellKey}.png" alt="${spell.name}">
>>>>>>> Stashed changes
=======
                spellCard.innerHTML = `
                    <img src="summoner_images/${spellKey}.png" alt="${spell.name}">
>>>>>>> Stashed changes
=======
                spellCard.innerHTML = `
                    <img src="summoner_images/${spellKey}.png" alt="${spell.name}">
>>>>>>> Stashed changes
                    <h3>${spell.name}</h3>
                    <p>${spell.description}</p>`;
                spellsContainer.appendChild(spellCard);
            }
        })
        .catch((error) => console.error("Erreur récupération des sorts :", error));

<<<<<<< Updated upstream
<<<<<<< Updated upstream
<<<<<<< Updated upstream
        // ⚡ Récupération des Runes
        fetch(
            "data/runesReforged.json"
        )
            .then((response) => response.json())
            .then((data) => {
                data.forEach((tree) => {
                    console.log("Runes Data:", data);
                    const runeTreeCard = document.createElement("div");
                    runeTreeCard.classList.add("card");

                    runeTreeCard.innerHTML = `
                    <img src="summoners_images/${tree.icon}" alt="${tree.name}">
                    <h3>${tree.name}</h3>
                    <p>${tree.slots[0].runes[0].name}</p>`;
                    runesContainer.appendChild(runeTreeCard);
                });
            })
            .catch((error) =>
                console.error("Erreur récupération des runes :", error)
            );
=======
    // ⚡ Récupération des Runes
    fetch("data/runesReforged.json")
        .then((response) => response.json())
        .then((data) => {
            data.forEach((tree) => {
                const runeTreeCard = document.createElement("div");
                runeTreeCard.classList.add("card");

                runeTreeCard.innerHTML = `
                    <img src="summoners_images/${tree.icon}" alt="${tree.name}">
                    <h3>${tree.name}</h3>
                    <p>${tree.slots[0].runes[0].name}</p>`;
=======
    // ⚡ Récupération des Runes
    fetch("data/runesReforged.json")
        .then((response) => response.json())
        .then((data) => {
            data.forEach((tree) => {
                const runeTreeCard = document.createElement("div");
                runeTreeCard.classList.add("card");

                runeTreeCard.innerHTML = `
                    <img src="summoners_images/${tree.icon}" alt="${tree.name}">
                    <h3>${tree.name}</h3>
                    <p>${tree.slots[0].runes[0].name}</p>`;
>>>>>>> Stashed changes
=======
    // ⚡ Récupération des Runes
    fetch("data/runesReforged.json")
        .then((response) => response.json())
        .then((data) => {
            data.forEach((tree) => {
                const runeTreeCard = document.createElement("div");
                runeTreeCard.classList.add("card");

                runeTreeCard.innerHTML = `
                    <img src="summoners_images/${tree.icon}" alt="${tree.name}">
                    <h3>${tree.name}</h3>
                    <p>${tree.slots[0].runes[0].name}</p>`;
>>>>>>> Stashed changes
                runesContainer.appendChild(runeTreeCard);
            });
        })
        .catch((error) => console.error("Erreur récupération des runes :", error));
<<<<<<< Updated upstream
<<<<<<< Updated upstream
>>>>>>> Stashed changes
=======
>>>>>>> Stashed changes
=======
>>>>>>> Stashed changes
});
