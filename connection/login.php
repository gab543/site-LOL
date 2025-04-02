<?php
session_start();
require_once('db.php');
if(isset($_POST['submit']))
{
	if(isset($_POST['username'],$_POST['password']) && !empty($_POST['username']) && !empty($_POST['password']))
	{
		$username = trim($_POST['username']);
		$password = trim($_POST['password']);
		$sql = "select * from members where username = :username ";
        $handle = $pdo->prepare($sql);
        $params = ['username'=>$username];
        $handle->execute($params);
        if($handle->rowCount() > 0)
        {
            $getRow = $handle->fetch(PDO::FETCH_ASSOC);
            if(password_verify($password, $getRow['password']))
            {
                unset($getRow['password']);
                $_SESSION = $getRow;
                header('location:../index.php');
                exit();
            }
            else
            {
                $errors[] = "Wrong username or Password";
            }
        }
        else
        {
            $errors[] = "Wrong username or Password";
        }
	}
	else
	{
		$errors[] = "username and Password are required";	
	}
}
?>
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
        <div class="errors">
            <?php 
				if(isset($errors) && count($errors) > 0)
				{
					foreach($errors as $error_msg)
					{
						echo '<div class="alert alert-danger">'.$error_msg.'</div>';
					}
				}
			?>
        </div>
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST"> 
            <div class="input-box">
                <input type="text" name="username" id="username" required>
                <label for="username">Nom d'utilisateur</label>
            </div>
            <div class="input-box">
                <input type="password" name="password" id="password" required>
                <label for="password">Mot de passe</label>
            </div>
            <button type="submit" name="submit">Se connecter</button>
            <p class="register">Pas encore inscrit ? <a href="register.php">Créer un compte</a></p>
        </form>
    </div>
</body>
</html>
