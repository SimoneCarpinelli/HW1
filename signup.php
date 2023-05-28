<?php
session_start();

// Verifica l'accesso
    if(isset($_SESSION["username"]))
    {
        // Vai alla home
        header("Location: homepage2.php");
        exit;
    }
    // Verifica l'esistenza di dati POST
    if( !empty($_POST["username"]) && !empty($_POST["password"]) && !empty($_POST["codfisc"])  && !empty($_POST["domicilio"]) && !empty($_POST["birth"]))
    {

        
        // Connessione al database
        $connection = mysqli_connect("localhost", "root", "", "fuzerecords") or die(mysqli_error($connection));
        // Controllo se esistono gi� username e codice fiscale


        $user=mysqli_real_escape_string($connection, $_POST["username"]);
        $query2="SELECT username FROM accounts WHERE username = '$user'";
        $res2=mysqli_query($connection,$query2);
        if(mysqli_num_rows($res2)>0){
                $error="username già in uso";
        }

        $cod=mysqli_real_escape_string($connection, $_POST["codfisc"]);
        $query1="SELECT CF FROM people WHERE CF = '$cod'";
        $res=mysqli_query($connection,$query1);
        if(mysqli_num_rows($res)>0){
            $error="Codice fiscale già inserito";
        }

        if (strlen($_POST["password"]) < 8) {
            $error = "Caratteri password insufficienti";
        }
        

        //inserimento dati
        if(!isset($error)){
 
            $domicilio=mysqli_real_escape_string($connection,$_POST["domicilio"]);
            $password = mysqli_real_escape_string($connection, $_POST["password"]);
            $password = password_hash($password, PASSWORD_BCRYPT);

            $new_date=$_POST["birth"];


            $queryper="insert into people(CF,data_di_nascita,Domicilio) values('$cod','$new_date','$domicilio')";
            $query = "insert into accounts(Username,password,CF) values('$user','$password','$cod')";


            if(  mysqli_query($connection,$queryper) && mysqli_query($connection,$query)){
            
                $_SESSION["username"] = $_POST["username"];
                mysqli_close($connection);
                header("Location: homepage2.php");

            }
            else{
                $error="errore di connessione al database";
            }
        }



    }
?>

<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="sign.css" />
    <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,300;0,400;1,200&display=swap" rel="stylesheet" />
    <title>Fuze Records</title>
    <script src="check2.js" defer="true"></script>

</head>
<body>

    <header>
        <nav>
            <div class="UPLeft">
                    <a id="logo1" href="homepage.php"><img src="Logo_mini.png" alt=""></a>
                    <div id="links">                 
                        <a href="#">Producers</a>
                        <a href="prodotti.php">Prodotti</a>
                        <a href="studios.php">Studios</a>
                    </div> 
                </div>
            
                
            </div>
            <div>
                <a class="buttons" href="login.php">accedi</a>
                
            </div>

            
        </nav>

    </header>
    <section>

        <main>
        
            <form name='signup' method='post' enctype="multipart/form-data"  autocomplete="off">
                <p class="username">
                    <label>
                        username
                        <input type='text' name='username' <?php if(isset($_POST["username"])){echo "value=".$_POST["username"];} ?> />
                        
                    </label>
                </p>
                <p class="password">
                    <label>
                        password
                        <input type='password' name='password' <?php if(isset($_POST["password"])){echo "value=".$_POST["password"];} ?> />
                    </label>
                </p>
                
                <p class="codfisc">
                    <label >
                        codice fiscale
                        <input type='text' name='codfisc' <?php if(isset($_POST["codfisc"])){echo "value=".$_POST["codfisc"];} ?> />
                    </label>

                </p>
                <p class="birth">
                    <label >
                        compleanno
                        <input type='date' name='birth' <?php if(isset($_POST["birth"])){echo "value=".$_POST["birth"];} ?> />
                    </label>
                </p>
                <p class="street">
                    <label >
                        domicilio
                        <input type='text' name='domicilio' <?php if(isset($_POST["domicilio"])){echo "value=".$_POST["domicilio"];} ?> />
                    </label>
                </p>

                <p>
                    <label class='submit'>
                        &nbsp;
                        <input type='submit' />
                    </label>
                </p>
            </form>
            
              <?php if(isset($error)) {echo "$error";} ?>
        </main>
            
                
            

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