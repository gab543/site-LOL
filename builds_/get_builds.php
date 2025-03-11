<?php
header("Content-Type: application/json");

// Connexion à la base de données
$conn = new mysqli("localhost", "root", "root", "site_LOL");

if ($conn->connect_error) {
    die(json_encode(["error" => "Connexion échouée"]));
}

// Récupération des builds
$result = $conn->query("SELECT * FROM builds");
$builds = [];

while ($row = $result->fetch_assoc()) {
    $builds[] = [
        "champion" => $row["champion"],
        "items" => json_decode($row["items"])
    ];
}

echo json_encode($builds);
$conn->close();
?>
