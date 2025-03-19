import os
import requests

# URL de base de l'API Data Dragon
DDRAGON_VERSION = "14.4.1"  # Remplace avec la dernière version si besoin
BASE_URL = f"https://ddragon.leagueoflegends.com/cdn/{DDRAGON_VERSION}/img/" 
RUNES_URL = f"https://ddragon.leagueoflegends.com/cdn/{DDRAGON_VERSION}/data/fr_FR/runesReforged.json"

# Dossier où enregistrer les images
download_folder = "rune_images"
os.makedirs(download_folder, exist_ok=True)

# Récupérer les données des runes
response = requests.get(RUNES_URL)
if response.status_code != 200:
    print("Erreur lors de la récupération des runes")
    exit()

data = response.json()

# Télécharger les images des runes
for tree in data:
    tree_icon_url = BASE_URL + tree["icon"]
    tree_icon_path = os.path.join(download_folder, os.path.basename(tree["icon"]))
    
    # Télécharger l'icône de l'arbre
    response = requests.get(tree_icon_url)
    if response.status_code == 200:
        with open(tree_icon_path, "wb") as f:
            f.write(response.content)
        print(f"Téléchargé : {tree_icon_path}")
    else:
        print(f"Erreur {response.status_code} pour {tree_icon_url}")

    
    # Télécharger les runes individuelles
    for slot in tree["slots"]:
        for rune in slot["runes"]:
            rune_icon_url = BASE_URL + rune["icon"]
            rune_icon_path = os.path.join(download_folder, os.path.basename(rune["icon"]))
            
            response = requests.get(tree_icon_url)
            if response.status_code == 200:
                with open(tree_icon_path, "wb") as f:
                    f.write(response.content)
                print(f"Téléchargé : {rune_icon_path}")
            else:
                print(f"Erreur {response.status_code} pour {rune_icon_url}")

print("Toutes les images de runes ont été téléchargées !")
