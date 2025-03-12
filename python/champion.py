import os
import requests

# URL du fichier JSON contenant les infos des champions
CHAMPION_JSON_URL = "https://ddragon.leagueoflegends.com/cdn/14.4.1/data/fr_FR/champion.json"
IMAGE_BASE_URL = "https://ddragon.leagueoflegends.com/cdn/14.4.1/img/champion/"

# Créer un dossier pour stocker les images
IMAGE_FOLDER = "champions_images"
os.makedirs(IMAGE_FOLDER, exist_ok=True)

# Télécharger le fichier JSON
response = requests.get(CHAMPION_JSON_URL)
if response.status_code == 200:
    champions_data = response.json()["data"]
    
    # Parcourir tous les champions
    for champ_name, champ_info in champions_data.items():
        image_url = IMAGE_BASE_URL + champ_info["image"]["full"]
        image_path = os.path.join(IMAGE_FOLDER, champ_info["image"]["full"])

        # Télécharger l'image si elle n'existe pas déjà
        if not os.path.exists(image_path):
            img_data = requests.get(image_url).content
            with open(image_path, "wb") as img_file:
                img_file.write(img_data)
            print(f"Téléchargé : {champ_info['image']['full']}")
        else:
            print(f"Déjà existant : {champ_info['image']['full']}")
else:
    print("Erreur lors du téléchargement du fichier JSON")
