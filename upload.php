<?php
session_start();

// Vérifier si le formulaire a été soumis
if (isset($_POST['submit'])) {
    // Vérification de l'existence d'un fichier
    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == 0) {
        $fileTmpPath = $_FILES['profile_picture']['tmp_name'];
        $fileName = $_FILES['profile_picture']['name'];
        $fileType = $_FILES['profile_picture']['type'];

        // Définir le répertoire de destination où stocker l'image
        $uploadDir = 'img/profiles/';
        
        // S'assurer que le dossier existe
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        // Générer un nom de fichier unique pour éviter les conflits
        $newFileName = uniqid() . '-' . $fileName;

        // Déplacer le fichier téléchargé vers le dossier de destination
        $uploadFilePath = $uploadDir . $newFileName;

        // Vérifier les extensions autorisées (par exemple, PNG, JPG, JPEG)
        $allowedExtensions = ['jpg', 'jpeg', 'png'];
        $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);

        if (in_array(strtolower($fileExtension), $allowedExtensions)) {
            // Déplacer l'image téléchargée
            if (move_uploaded_file($fileTmpPath, $uploadFilePath)) {
                echo "La photo de profil a été changée avec succès!";
                // Optionnel : stocker le nom de l'image dans une session ou une base de données
                $_SESSION['profile_picture'] = $newFileName;
            } else {
                echo "Une erreur est survenue lors du téléchargement de la photo.";
            }
        } else {
            echo "Seules les images JPG, JPEG et PNG sont autorisées.";
        }
    } else {
        echo "Aucune image n'a été téléchargée ou il y a une erreur.";
    }
}
?>
