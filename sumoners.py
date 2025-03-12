import os
import requests

# URL du fichier JSON des sorts d'invocateur
SUMMONER_JSON_URL = "https://ddragon.leagueoflegends.com/cdn/14.4.1/data/fr_FR/summoner.json"
IMAGE_BASE_URL = "https://ddragon.leagueoflegends.com/cdn/14.4.1/img/spell/"

# Créer un dossier pour stocker les images
IMAGE_FOLDER = "summoners_images"
os.makedirs(IMAGE_FOLDER, exist_ok=True)

# Télécharger le fichier JSON
response = requests.get(SUMMONER_JSON_URL)
if response.status_code == 200:
    summoners_data = response.json()["data"]
    
    # Parcourir tous les sorts d'invocateur
    for spell_key, spell_info in summoners_data.items():
        image_url = IMAGE_BASE_URL + spell_info["image"]["full"]
        image_path = os.path.join(IMAGE_FOLDER, spell_info["image"]["full"])

        # Télécharger l'image si elle n'existe pas déjà
        if not os.path.exists(image_path):
            img_data = requests.get(image_url).content
            with open(image_path, "wb") as img_file:
                img_file.write(img_data)
            print(f"Téléchargé : {spell_info['image']['full']}")
        else:
            print(f"Déjà existant : {spell_info['image']['full']}")
else:
    print("Erreur lors du téléchargement du fichier JSON")
