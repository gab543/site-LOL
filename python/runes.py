import os

# Dossier où tu as téléchargé les images des runes
runes_folder = "runes_images"

# Vérifier si le dossier existe
if not os.path.exists(runes_folder):
    print(f"Erreur : Le dossier '{runes_folder}' n'existe pas.")
else:
    # Lister les fichiers dans le dossier
    rune_images = [f for f in os.listdir(runes_folder) if f.endswith((".png", ".jpg", ".jpeg"))]

    if not rune_images:
        print("Aucune image de rune trouvée dans le dossier.")
    else:
        print("Images de runes trouvées :")
        for image in rune_images:
            print(f"- {image}")
