<?php
session_start();
require_once('db.php');

if(isset($_POST['submit']))
{
    if(isset($_POST['first_name'],$_POST['last_name'],$_POST['username'],$_POST['password']) && !empty($_POST['first_name']) && !empty($_POST['last_name']) && !empty($_POST['username']) && !empty($_POST['password']))
    {
        $firstName = trim($_POST['first_name']);
        $lastName = trim($_POST['last_name']);
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
        
        $options = array("cost"=>4);
        $hashPassword = password_hash($password,PASSWORD_BCRYPT,$options);
            $sql = 'select * from members where username = :username';
            $stmt = $pdo->prepare($sql);
            $p = ['username'=>$username];
            $stmt->execute($p);
            
            if($stmt->rowCount() == 0)
            {
                $sql = "insert into members (first_name, last_name, username, `password`) values(:fname,:lname,:username,:pass)";
            
                try{
                    $handle = $pdo->prepare($sql);
                    $params = [
                        ':fname'=>$firstName,
                        ':lname'=>$lastName,
                        ':username'=>$username,
                        ':pass'=>$hashPassword,
                    ];
                    
                    if ($handle->execute($params)) {
                        // Récupérer l'ID de l'utilisateur nouvellement inscrit
                        $user_id = $pdo->lastInsertId();
                        
                        // Définir les informations de session essentielles
                        $_SESSION['id'] = $user_id;
                        $_SESSION['username'] = $username;
                        $_SESSION['first_name'] = $firstName;
                        $_SESSION['last_name'] = $lastName;
                        $_SESSION['loggedin'] = true;
                        
                        $success = 'User has been created successfully. Logging in...';
                    }
                    
                }
                catch(PDOException $e){
                    $errors[] = $e->getMessage();
                }
            }
            else
            {
                $valFirstName = $firstName;
                $valLastName = $lastName;
                $valusername = '';
                $valPassword = $password;

                $errors[] = 'username address already registered';
            }
    }
    else
    {
        if(!isset($_POST['first_name']) || empty($_POST['first_name']))
        {
            $errors[] = 'First name is required';
        }
        else
        {
            $valFirstName = $_POST['first_name'];
        }
        if(!isset($_POST['last_name']) || empty($_POST['last_name']))
        {
            $errors[] = 'Last name is required';
        }
        else
        {
            $valLastName = $_POST['last_name'];
        }

        if(!isset($_POST['username']) || empty($_POST['username']))
        {
            $errors[] = 'username is required';
        }
        else
        {
            $valusername = $_POST['username'];
        }

        if(!isset($_POST['password']) || empty($_POST['password']))
        {
            $errors[] = 'Password is required';
        }
        else
        {
            $valPassword = $_POST['password'];
        }
        
    }

}
?>


<!doctype html>
<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

</head>
<body class="bg-dark">

<div class="container h-100">
	<div class="row h-100 mt-5 justify-content-center align-items-center">
		<div class="col-md-5 mt-3 pt-2 pb-5 align-self-center border bg-light">
			<h1 class="mx-auto w-25" >Register</h1>
			<?php 
				if(isset($errors) && count($errors) > 0)
				{
					foreach($errors as $error_msg)
					{
						echo '<div class="alert alert-danger">'.$error_msg.'</div>';
					}
                }
                
                if(isset($success))
                {
                    echo '<div class="alert alert-success">'.$success.'</div>';
                    echo '<script>
                            setTimeout(function() {
                                window.location.href = "../index.php";
                            }, 1000);
                        </script>';
                    
                }
			?>
			<form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
                <div class="form-group">
					<label for="first_name">First Name:</label>
					<input type="text" name="first_name" id="first_name" placeholder="Enter First Name" class="form-control" value="<?php echo $valFirstName??''?>">
                    <script type="text/javascript">
                        var text = document.getElementById('first_name'); // On récupère le texte
                        text.addEventListener('focus', function(e) { // On fait un event pour savoir si il est focus
                        if(e.target.value != "") // Si y'a une valeur dans l'input
                            e.target.style.backgroundColor = "transparent" ; // On met le fond en rouge, Oublie des guillemets
                        }, true);
                    </script>
				</div>
                <div class="form-group">
					<label for="last_name">Last Name:</label>
					<input type="text" name="last_name" id="last_name" placeholder="Enter Last Name" class="form-control" value="<?php echo $valLastName??''?>">
				</div>

                <div class="form-group">
					<label for="username">Username:</label>
					<input type="text" name="username" id="username" placeholder="Enter username" class="form-control" value="<?php echo $valusername??''?>">
				</div>
				<div class="form-group">
				<label for="password">Password:</label>
					<input type="password" name="password" id="password" placeholder="Enter Password" class="form-control" value="<?php echo $valPassword??''?>">
				</div>

				<button type="submit" name="submit" class="btn btn-primary">Submit</button>
				<p class="pt-2"> Back to <a href="login.php">Login</a></p>
				
			</form>
		</div>
	</div>
</div>
</body>
</html>