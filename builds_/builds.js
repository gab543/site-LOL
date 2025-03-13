document.addEventListener("DOMContentLoaded", () => {
    console.log("Script chargé !");
    const itemBoxes = document.querySelectorAll(".item-box");
    const modal = document.getElementById("modal");
    const modalItemList = document.getElementById("modal-item-list");
    const modalSearch = document.getElementById("modal-search");
    const closeModalBtn = document.querySelector(".close-modal");
    const spellsContainer = document.getElementById("summoner-spells");
    const runesContainer = document.getElementById("runes");
    let itemsData = {};
    let selectedBoxIndex = null;

    // Vérifier que les cases sont bien reconnues et ajouter l'événement de clic
    itemBoxes.forEach((box) => {
        box.addEventListener("click", function () {
            selectedBoxIndex = this.dataset.index; // Stocke l'index de la case cliquée
            openModal();
        });
    });

    // Fonction pour ouvrir le modal
    function openModal() {
        modal.style.display = "block";
        modalSearch.value = "";
        populateModalItems(itemsData); // Remplir la liste des items
    }

    // Fermer le modal quand on clique sur (X)
    closeModalBtn.addEventListener("click", () => {
        modal.style.display = "none";
    });

    // Fermer le modal en cliquant en dehors
    window.addEventListener("click", (e) => {
        if (e.target === modal) {
            modal.style.display = "none";
        }
    });

    // Charger la liste des items depuis l'API Riot
    fetch("data/item.json")
        .then((response) => response.json())
        .then((data) => {
            itemsData = data.data;
            populateModalItems(itemsData);
        });

    // Remplir la liste des items dans le modal
    function populateModalItems(items) {
        modalItemList.innerHTML = ""; // On vide la liste avant de remplir
    
        const seenItems = new Set(); // Pour éviter les doublons
    
        for (const itemId in items) {
            const item = items[itemId];
    
            // Vérifier si l'objet est achetable
            if (!item.gold.purchasable) continue;
    
            // Ignorer les items dont l'ID commence par "22"
            if (itemId.startsWith("22")) continue;

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
            `;
    
            modalItemList.appendChild(itemDiv);
        }
    }
    
    

    // Sélection d'un item dans le modal
    modalItemList.addEventListener("click", (e) => {
        let target = e.target;
        while (target && !target.dataset.itemId) {
            target = target.parentNode; // Remonter jusqu'à l'élément qui contient l'ID
        }
        if (target && target.dataset.itemId) {
            const selectedItemId = target.dataset.itemId;
            const selectedBox = document.querySelector(
                `.item-box[data-index="${selectedBoxIndex}"]`
            );
            selectedBox.innerHTML = `<img src="items_images/${selectedItemId}.png" alt="Item">`;
            selectedBox.dataset.itemId = selectedItemId;
            modal.style.display = "none"; // Fermer le modal après sélection
        }
    });


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
                    <h3>${spell.name}</h3>
                    <p>${spell.description}</p>`;
                    spellsContainer.appendChild(spellCard);
                }
            })
            .catch((error) =>
                console.error("Erreur récupération des sorts :", error)
            );

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
});
