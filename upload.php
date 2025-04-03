<?php
session_start();
require_once('connection/db.php');

if (isset($_POST['submit']) && isset($_SESSION['loggedin'])) {
    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == 0) {
        $allowed = ['jpg', 'jpeg', 'png'];
        $filename = $_FILES['profile_picture']['name'];
        $filetype = $_FILES['profile_picture']['type'];
        $filesize = $_FILES['profile_picture']['size'];
        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

        if (in_array($ext, $allowed)) {
            // Créer un nom de fichier unique
            $newname = uniqid() . '.' . $ext;
            $destination = __DIR__ . '/img/profiles/' . $newname;

            if (move_uploaded_file($_FILES['profile_picture']['tmp_name'], $destination)) {
                // Mise à jour de la base de données
                $sql = "UPDATE members SET profile_picture = :picture WHERE username = :username";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([
                    ':picture' => $newname,
                    ':username' => $_SESSION['username']
                ]);

                // Mettre à jour la session
                $_SESSION['profile_picture'] = $newname;
                
                header('Location: index.php');
                exit();
            }
        }
    }
}
header('Location: index.php');
?>
