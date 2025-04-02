
<style>
    body {
        font-family: Arial, sans-serif;
        padding: 20px;
        color : #bdbdbd;
        background-color : #2a2a2a;
        text-decoration: none;
    }
    nav {
        background-color: #222;
        padding: 30px;
        margin: 0px;
        border : 0px;
        display: flex;
        justify-content: center;
    }
    .nav-links {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        gap: 20px;
    }
    .nav-links li {
        display: inline;
    }
    .nav-links a {
        color: white;
        text-decoration: none;
        font-size: 18px;
        padding: 10px 15px;
        transition: 0.3s;
    }
    .nav-links a:hover {
        background-color: #444;
        border-radius: 5px;
    }
    /* The dropdown container */
    .dropdown {
    float: left;
    overflow: hidden;
    }

    /* Dropdown button */
    .dropdown .dropbtn {
    font-size: 16px;
    border: none;
    outline: none;
    color: white;
    padding: 14px 16px;
    background-color: inherit;
    font-family: inherit;
    margin: 0;
    }

    /* Add a red background color to navbar links on hover */
    .navbar a:hover, .dropdown:hover .dropbtn {
    background-color: red;
    }

    /* Dropdown content (hidden by default) */
    dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
    }

    /* Links inside the dropdown */
    dropdown-content a {
    float: none;
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
    text-align: left;
    }

    /* Add a grey background color to dropdown links on hover */
    dropdown-content a:hover {
    background-color: #ddd;
    }

    /* Show the dropdown menu on hover */
    .dropdown:hover .dropdown-content {
    display: block;
    }
</style>
<nav>
    <ul class="nav-links">
        <li><a href="http://localhost/site-LOL/index.php">Accueil</a></li>
        <li><a href="http://localhost/site-LOL/champions/champions.php">Champions</a></li>
        <li><a href="http://localhost/site-LOL/builds_/builds.php">Builds</a></li>
        <?php
        SESSION_START();
        if (isset($_SESSION['username']))
        {
            echo '<div class="dropdown">
                    <button class="dropbtn">Mon compte
                    <i class="fa fa-caret-down"></i>
                    </button>
                        <div class="dropdown-content">
                        <a href="http://localhost/site-LOL/connection/logout.php">Déconnexion</a>
                        </div>
                </div>';
        }
        else
        {
            echo '<li><a href="http://localhost/site-LOL/connection/register.php">Inscription</a></li>';
            echo '<li><a href="http://localhost/site-LOL/connection/login.php">Connexion</a></li>';
        }
        ?>
    </ul>
</nav>
