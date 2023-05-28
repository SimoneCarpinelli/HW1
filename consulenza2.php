<?php
 session_start();

 // Verifica la sessione utente
 if (!isset($_SESSION["username"])) {
     // L'utente è già autenticato, reindirizza alla homepage
     header("Location: login.php");
     exit;
 }
 
 $conn = mysqli_connect("localhost", "root", "", "fuzerecords") or die(mysqli_error($conn));
 
 if (!empty($_POST["mail"]) && !empty($_POST["telefono"])) {
     $username = $_SESSION["username"];
     $escapedMail = mysqli_real_escape_string($conn, $_POST["mail"]);
     $escapedTelefono = mysqli_real_escape_string($conn, $_POST["telefono"]);
 
     $query = "SELECT id FROM accounts WHERE Username = '$username'";
     $result = mysqli_query($conn, $query);
     $row = mysqli_fetch_assoc($result);
     $idAccount = $row['id'];
 
     $query2="SELECT mail FROM consulenza WHERE mail = '$escapedMail'";
     $res2=mysqli_query($conn,$query2);
     if(mysqli_num_rows($res2)>0){
             $error="mail già registrata";
     }

     
        $query3="SELECT telefono FROM consulenza WHERE telefono = '$escapedTelefono'";
        $res3=mysqli_query($conn,$query3);
        if(mysqli_num_rows($res3)>0){
            $error="Numero di telefono già inserito";
        }

        if(!isset($error)){
            $query4 = "INSERT INTO `consulenza` (`telefono`, `mail`, `accounts_id`) VALUES ('$escapedTelefono', '$escapedMail', '$idAccount')";
            
            if(mysqli_query($conn,$query4)){
            
                mysqli_close($conn);
                header("Location: consulenza2.php");

            }
            else{
                $error="errore di connessione al database";
            }
        }  

     
 }
 
 mysqli_close($conn);
 

    ?>

<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="consulenza.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Raleway&display=swap" rel="stylesheet">
        <script src="checkmailtel.js" defer="true"></script>
        <title> Fuze Records </title>
    </head>
    <body> 
        <nav>
            <div class="UPLeft">
                <div class="logo">
                    <a id="logo1" href="homepage2.php"><img src="Logo_mini.png" alt=""></a>
                </div>
                
                <div class="link">
                    <a href="">Producers</a>
                    <a href="prodotti2.php">Prodotti</a>
                    <a href="">Studios</a>
                </div>

            </div>

            <div>
                <a class="buttons" href="logout.php">log-out</a>
                
            </div>
            <div  id="menu">
                <div></div>
                <div></div>
                <div></div>
            </div>
        </nav>
        <header>

        </header>

        <section>
            <h1>progetta il tuo studio</h1>
            <p>
                i nostri migliori ingegneri del suono ti contatteranno <br>
                per aiutarti a realizzare lo studio dei tuoi sogni
            </p>
            <article>
                <div id="container">

                    <div id="riquadro">
                        <div class="blocco">
                            <img src="studio2.png"></img>
                            <img src="studio3.png"></img>
                        </div>
                        <div class="blocco">
                            <img src="studio4.png"></img> 
                            <img src="studio5.png"></img> 
                        </div>
                    </div>
                       
                    <div>
                    <div id="box">
                        <h4>
                            lascia qui i tuoi recapiti
                        </h4>
                        <form name='consulenza' method='post' enctype="multipart/form-data"  autocomplete="off">
                            <p class="mail">
                                <label>
                                    mail
                                    <input type='text' name='mail'  />
                                </label>
                            </p>
                        

                            <p class="telefono">
                                <label>
                                    telefono
                                    <input type='text' name='telefono'  />
                                </label>
                            </p>

                            <p>
                                <label>
                                    &nbsp;
                                    <input type='submit' id='subButton'/>
                                </label>
                            </p>
                        </form> 
                        <?php if(isset($error)) {echo "$error";} ?>    
                </div>
                </div>
            </article>
        </section>
       
        
        <footer>
            <em>powered by Simone Carpinelli 1000011314</em>
            <p>follow us on</p>
            <div >
                <a href=""><img src="facebook.png" alt=""> </a>
                <a href=""><img src="Instagram_logo.png" alt=""></a>
            </div>
        </footer>
    </body>

</html>