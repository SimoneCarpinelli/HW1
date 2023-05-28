
<?php
session_start();

require_once 'cookieAuth.php';
$user_id = checkAuth();

if(isset($user_id)){
    header("Location: prodotti2.php");
    exit;
}
// Verifica la sessione utente
/*
if (isset($_SESSION["username"])) {
    
    // L'utente è già autenticato, reindirizza alla homepage
    header("Location: prodotti2.php");
    exit;
}
*/

?>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="prodotti.css">
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
                    <a href="studios.php">Studios</a>
                </div>

            </div>

            <div>
                <a class="buttons" href="login.php">accedi</a>
                <a class="buttons" href="signup.php">registrati</a>
            </div>
            
        </nav>
        <header>

        </header>

        <section>
            <div id='productContainer'>
                <?php
                // Connessione al database

                $conn = new mysqli('localhost','root','','fuzerecords');

                if ($conn->connect_error) {
                    die("Connessione al database fallita: " . $conn->connect_error);
                }

                // Query per selezionare i prodotti dalla tabella "products"
                $sql = "SELECT * FROM products";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // Visualizzazione dei prodotti
                    while($row = $result->fetch_assoc()) {
                        echo "<div class='product'>";
                        echo "<img src='" . $row['img'] . "' alt='" . $row['name'] . "'>";
                            echo "<div class='desc'>";
                                echo "<p>" . $row['marca']  . "</p>";
                                echo "<h3>" . $row['name'] . "</h3>";
                                echo "<p class='price'>€".$row['costo']. "</p>";
                              
                                
                                echo "</div>";
                        echo "</div>";
                    }
                } else {
                echo "Nessun prodotto trovato.";
                }

                $conn->close(); 
                ?>      
            </div>    
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