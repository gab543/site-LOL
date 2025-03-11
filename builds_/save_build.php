<?php
header("Content-Type: application/json");

// Connexion à la base de données
$conn = new mysqli("localhost", "root", "root", "site_LOL");

if ($conn->connect_error) {
    die(json_encode(["error" => "Connexion échouée"]));
}

// Récupération des données envoyées en JSON
$data = json_decode(file_get_contents("php://input"), true);
$champion = $conn->real_escape_string($data["champion"]);
$items = json_encode($data["items"]);

// Insertion dans la base de données
$sql = "INSERT INTO builds (champion, items) VALUES ('$champion', '$items')";
$conn->query($sql);

echo json_encode(["success" => true]);
$conn->close();
?>
