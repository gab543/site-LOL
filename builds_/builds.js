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

    // Clic sur les cases d'objets
    itemBoxes.forEach((box) => {
        box.addEventListener("click", function () {
            selectedBoxIndex = this.dataset.index;
            openModal();
        });
    });

    function openModal() {
        modal.style.display = "block";
        modalSearch.value = "";
        populateModalItems(itemsData);
    }

    closeModalBtn.addEventListener("click", () => {
        modal.style.display = "none";
    });

    window.addEventListener("click", (e) => {
        if (e.target === modal) {
            modal.style.display = "none";
        }
    });

    // Charger les items
    fetch("data/item.json")
        .then((response) => response.json())
        .then((data) => {
            itemsData = data.data;
            populateModalItems(itemsData);
        })
        .catch(error => console.error("Erreur lors du chargement des items:", error));

    function populateModalItems(items) {
        modalItemList.innerHTML = "";
        for (const itemId in items) {
            const item = items[itemId];
            if (!item.gold.purchasable || itemId.startsWith("22")) continue;
            const itemDiv = document.createElement("div");
            itemDiv.dataset.itemId = itemId;
            itemDiv.innerHTML = `
                <img src="../images/items_images/${itemId}.png" alt="${item.name}">
                <p>${item.name}</p>
            `;
            modalItemList.appendChild(itemDiv);
        }
    }

    // Charger les sorts d'invocateur
    fetch("data/summoner.json")
        .then(response => response.json())
        .then(data => {
            const spells = data.data;
            for (const spellKey in spells) {
                const spell = spells[spellKey];
                const spellCard = document.createElement("div");
                spellCard.classList.add("card");
                spellCard.innerHTML = `
                    <img src="../images/summoners_images/${spellKey}.png" alt="${spell.name}">
                    <h3>${spell.name}</h3>
                    <p>${spell.description}</p>
                `;
                spellsContainer.appendChild(spellCard);
            }
        })
        .catch(error => console.error("Erreur récupération des sorts :", error));

    // Charger les runes
    fetch("data/runesReforged.json")
        .then(response => response.json())
        .then(data => {
            data.forEach((tree) => {
                const runeTreeCard = document.createElement("div");
                runeTreeCard.classList.add("card");
                runeTreeCard.innerHTML = `
                    <img src="rune_images/${tree.id}.png" alt="${tree.name}">
                    <img src="../images/rune_images/${tree.id}.png" alt="${tree.name}">
                    <h3>${tree.name}</h3>
                `;
                runesContainer.appendChild(runeTreeCard);
            });
        })
        .catch(error => console.error("Erreur récupération des runes :", error));

    // Gestion du clic sur l'image du champion
    document.querySelectorAll(".champion-card").forEach(card => {
        card.addEventListener("click", function () {
            const championName = this.dataset.name;
            if (championName) {
                window.location.href = `champion.html?name=${championName}`;
            }
        });
    });
});
