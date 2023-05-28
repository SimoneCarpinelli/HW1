<?php


// Verifica l'accesso
session_start();
require_once 'cookieAuth.php';
$user_id = checkAuth();

if(isset($user_id)){
    header("Location: homepage2.php");
    exit;
}

/*
if (isset($_SESSION["username"])) {
    header("Location: homepage2.php");
    exit;
}

*/

// Verifica l'esistenza di dati POST
if (!empty($_POST["username"]) && !empty($_POST["password"])) {
    // Connetti al database
    $connection = mysqli_connect("localhost", "root", "", "fuzerecords") or die(mysqli_error($connection));

    $user = mysqli_real_escape_string($connection, $_POST["username"]);
    $pass = mysqli_real_escape_string($connection, $_POST["password"]);

    $query = "SELECT username, password, id FROM accounts WHERE username = '$user'";
    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($_POST["password"], $row["password"])) {
            $errore = false;
            mysqli_query($connection, $query) or die(mysqli_error($connection));      
            $_SESSION["username"] = $row["username"];
            $_SESSION["id"] = $row["id"];
           
            $token = random_bytes(12);
            $hash = password_hash($token, PASSWORD_BCRYPT);
            $expires = strtotime('+1 day');
            $expires_date = date("Y-m-d H:i:s",$expires);
            $query = "INSERT INTO cookie(hash, user_id, expires) VALUES('".$hash."', ".$row['id'].", '".$expires_date."')";
            mysqli_query($connection, $query) or die(mysqli_error($connection));
            setcookie("user_id", $row['id'], $expires );
            setcookie("cookie_id", mysqli_insert_id($connection), $expires);
            setcookie("token", $token, $expires);
            
            header("Location: homepage2.php");
            mysqli_close($connection);
            exit;
        }
         else {
            $errore = true;
        }

    }
} else {
    // Flag di errore
    $errore = true;
}
?>


<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="log.css" />
    <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,300;0,400;1,200&display=swap" rel="stylesheet" />
    <title>Fuze Records</title>

</head>
<body>
   
    <header>
        <nav>
            <div class="UPLeft">
                <a id="logo1" href="homepage.php"><img src="Logo_mini.png" alt=""></a>
                <div id="links">
                    <a href="#">Producers</a>
                    <a href="prodotti.php">Prodotti</a>
                    <a href="#">Studios</a>
                </div>  
            </div>

            <div>
                <a class="buttons" href="signup.php">Registrati</a>
            </div>
        </nav>
    </header>
    <section>
        <div>
            <form name="nome_form" method="post">
                <p>
                    <label>
                        Username
                        <input type="text" name="username" value="<?php if(isset($_POST["username"])){echo $_POST["username"];} ?>" />
                    </label>
                </p>
                <p>
                    <label>
                        Password 
                        <input type="password" name="password" />
                    </label>
                </p>
                <p>
                    <label>
                        &nbsp;
                        <input type="submit" />
                    </label>
                </p>
            </form>

            <?php if(isset($errore)) {
                echo "<p class='errore'>";
                echo "Credenziali non valide.";
                echo "</p>";
            } 
            ?>
        </div>
    </section>
    <footer>
        <em>powered by Simone Carpinelli 1000011314</em>
        <p>follow us on</p>
        <div>
            <a href="">
                <img src="facebook.png" alt="" />
            </a>
            <a href="">
                <img src="Instagram_logo.png" alt="" />
            </a>
        </div>
    </footer>
</body>
</html>
