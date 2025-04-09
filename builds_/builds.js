import { filterItems } from './filters.js';

document.addEventListener("DOMContentLoaded", () => {
    console.log("Script chargé !");
    const itemBoxes = document.querySelectorAll(".item-box");
    const tooltip = document.getElementById('tooltip');
    const items = document.querySelectorAll('.item-list');
    const modal = document.getElementById("modal");
    const modalItemList = document.getElementById("modal-item-list");
    const modalSearch = document.getElementById("modal-search");
    const closeModalBtn = document.querySelector(".close-modal");
    const spellsContainer = document.getElementById("summoner-spells");
    const runesContainer = document.getElementById("runes");
    let itemsData = {};
    let selectedBoxIndex = null;
    let activeFilters = new Set(); // Ajouter au début avec les autres variables

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
        document.getElementsByTagName("body")[0].style.overflow = "hidden";
    }

    closeModalBtn.addEventListener("click", () => {
        modal.style.display = "none";
    });

    window.addEventListener("click", (e) => {
        if (e.target === modal) {
            modal.style.display = "none";
        }
    });

    // Charger les items depuis un fichier JSON
    fetch("../data/item.json")
        .then((response) => response.json())
        .then((data) => {
            itemsData = data.data;
            populateModalItems(itemsData);
        })
        .catch(error => console.error("Erreur lors du chargement des items:", error));

    // Fonction pour afficher les objets dans le modal
    function populateModalItems(items) {
        const modalItemList = document.querySelector('#modal-item-list');
        if (!modalItemList) {
            console.error("L'élément modal-item-list n'a pas été trouvé.");
            return;
        }
        modalItemList.innerHTML = ""; // Effacer les éléments existants
        if (Object.keys(items).length === 0) {
            modalItemList.innerHTML = "<p>Aucun objet trouvé avec les filtres sélectionnés.</p>";
            return;
        }
        
        for (const itemId in items) {
            const item = items[itemId];

            // Vérifier l'itemId et afficher un message dans la console
            //console.log("itemId:", itemId); // Ceci va t'aider à vérifier si l'itemId est correct
            
            // Vérification de conditions (exemple : si l'objet est achetable, s'il n'a pas de champion requis, etc.)
            if (!item.gold.purchasable || item.requiredChampion || item.requiredAlly || item.maps["11"] === false) {
                continue;
            }

            const itemDiv = document.createElement("div");
            itemDiv.classList.add("item");
            itemDiv.dataset.itemId = itemId;
            itemDiv.innerHTML = `
                <img src="../img/items_images/${itemId}.png" data-description="${item.description}" alt="${item.name}">
                <p>${item.name}</p>
            `;
            modalItemList.appendChild(itemDiv);
        }
    }

    // Gérer les filtres
    document.querySelectorAll('.filter-btn').forEach(button => {
        button.addEventListener('click', () => {
            const stat = button.getAttribute('data-stat');
            
            // Toggle du filtre
            if (activeFilters.has(stat)) {
                activeFilters.delete(stat);
                button.classList.remove('active');
            } else {
                activeFilters.add(stat);
                button.classList.add('active');
            }

            // Appliquer tous les filtres actifs
            let filteredItems = itemsData;
            if (activeFilters.size > 0) {
                filteredItems = Object.fromEntries(
                    Object.entries(itemsData).filter(([_, item]) => {
                        return Array.from(activeFilters).every(stat => {
                            return item.stats && 
                                Object.keys(item.stats).some(statName => 
                                    statName.toLowerCase().includes(stat.toLowerCase())
                                );
                        });
                    })
                );
            }
            
            populateModalItems(filteredItems);
        });
    });

    // Supprimer l'ancienne fonction filterItems() ici

    // Fonction pour supprimer les accents et les caractères spéciaux
    function removeAccents(str) {
        // Remplacer les ligatures comme "œ" par "oe"
        str = str.replace(/œ/g, 'oe');
        
        // Normaliser les caractères accentués et enlever les marques diacritiques
        return str.normalize("NFD").replace(/[\u0300-\u036f]/g, "");
    }

    // Ajout de l'écouteur d'événement pour la barre de recherche
    document.getElementById("modal-search").addEventListener("input", function() {
        let searchValue = this.value.toLowerCase();
        // Normaliser la recherche (retirer les accents et les caractères spéciaux)
        let normalizedSearchValue = removeAccents(searchValue);

        let items = document.querySelectorAll(".item");

        items.forEach(item => {
            let itemName = item.innerText.toLowerCase();
            // Normaliser les noms des éléments pour enlever les accents aussi
            let normalizedItemName = removeAccents(itemName);

            // Comparer la recherche normalisée avec les noms normalisés
            if (normalizedItemName.includes(normalizedSearchValue)) {
                item.style.display = "block";
            } else {
                item.style.display = "none";
            }
        });
    });
    

    // Charger les sorts d'invocateur
    fetch("../data/summoner.json")
    .then(response => response.json())
    .then(data => {
        const spells = data.data;
        for (const spellKey in spells) {
            const spell = spells[spellKey];
            if (spell.key == "54" || spell.key == "55") continue; // Correction ici
            const spellCard = document.createElement("div");
            spellCard.classList.add("card");
            spellCard.innerHTML = `
                <img src="../img/summoners_images/${spellKey}.png" alt="${spell.name}">
                <h3>${spell.name}</h3>
                <p>${spell.description}</p>
            `;
            spellsContainer.appendChild(spellCard);
        }
    })
    .catch(error => console.error("Erreur récupération des sorts :", error));

    // Charger les runes
    fetch("../data/runesReforged.json")
        .then(response => response.json())
        .then(data => {
            data.forEach((tree) => {
                const runeTreeCard = document.createElement("div");
                runeTreeCard.classList.add("card");
                runeTreeCard.innerHTML = `
                    <img src="../img/${tree.icon}" alt="${tree.name}">
                    <h3>${tree.name}</h3>
                `;
                runesContainer.appendChild(runeTreeCard);
            });
        })
        .catch(error => console.error("Erreur récupération des runes :", error));

        items.forEach(item => {
            // Ajouter un écouteur d'événements au survol (mouseenter)
            item.addEventListener('mouseenter', (e) => {
            const description = e.target.getAttribute('data-description');
              tooltip.textContent = description;  // Insère la description dans le tooltip
              tooltip.style.display = 'block';  // Affiche le tooltip
            });
        
            // Ajouter un écouteur pour déplacer le tooltip (mousemove)
            item.addEventListener('mousemove', (e) => {
              tooltip.style.left = e.pageX + 10 + 'px';  // Positionner à côté de la souris (10px de marge)
              tooltip.style.top = e.pageY + 10 + 'px';   // Positionner à côté de la souris (10px de marge)
            });
        
            // Cacher le tooltip quand la souris quitte l'élément (mouseleave)
            item.addEventListener('mouseleave', () => {
              tooltip.style.display = 'none';  // Masquer le tooltip
            });
        });
});
