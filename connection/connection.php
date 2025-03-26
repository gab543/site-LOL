<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="style--connection.css"> <!-- Lien vers ton CSS -->
</head>
<body>
    <div class="container">
        <h2>Connexion</h2>
        <form action="traitement_login.php" method="POST"> 
            <div class="input-box">
                <input type="text" name="username" required>
                <label>Nom d'utilisateur</label>
            </div>
            <div class="input-box">
                <input type="password" name="password" required>
                <label>Mot de passe</label>
            </div>
            <button type="submit">Se connecter</button>
            <p class="register">Pas encore inscrit ? <a href="register.php">Créer un compte</a></p>
        </form>
    </div>
</body>
</html>
