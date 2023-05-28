<?php
    session_start();

    require_once 'cookieAuth.php';
    $user_id = checkAuth();
    
    if(isset($user_id)){
        header("Location: consulenza2.php");
        exit;
    } 
    
    // Verifica la sessione utente
    /*
    if (isset($_SESSION["username"])) {
        header("Location: consulenza2.php");
        exit;
    }
*/

    ?>

<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="consulenza.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Raleway&display=swap" rel="stylesheet">
        <script src="mhw3.js" defer="true"></script>
        <title> Fuze Records </title>
    </head>
    <body> 
        <nav>
            <div class="UPLeft">
                <div class="logo">
                    <a id="logo1" href="homepage.php"><img src="Logo_mini.png" alt=""></a>
                </div>
                
                <div class="link">
                    <a href="">Producers</a>
                    <a href="prodotti.php">Prodotti</a>
                    <a href="studios.php">Studios</a>
                </div>

            </div>

            <div>
                <a class="buttons" href="login.php">accedi</a>
                <a class="buttons" href="signup.php">registrati</a>
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
                        <a href='login.php'>Accedi per chiedere consulenza</a>
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