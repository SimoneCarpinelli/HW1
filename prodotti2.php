
<?php
session_start();


// Connessione al database

$conn = new mysqli('localhost','root','','fuzerecords');

if ($conn->connect_error) {
    die("Connessione al database fallita: " . $conn->connect_error);
}

$query = "SELECT * FROM products";
$result = $conn->query($query);

?>


<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="prodotti.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Raleway&display=swap" rel="stylesheet">
        <script src="cart.js" defer="true"></script>
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
                    <a href="studios2.php">Studios</a>
                </div>

            </div>

            <div>
                <a class="buttons" href="logout.php">log-out</a>
            </div>

            
        </nav>
        <header>

        </header>

        <section>
            <div id='productContainer'>
            <?php

                //$query = "SELECT p.marca, p.img,p.name, cp.costo FROM products p JOIN copyproducts cp on  cp.products_id = p.id";
                
                $query = "SELECT * FROM products";
                $result = $conn->query($query);

                if ($result->num_rows > 0) {
                    
                    while($row = $result->fetch_assoc()) {
                        echo "<div class='product'>";
                        echo "<img src='" . $row['img'] . "' alt='" . $row['name'] . "'>";
                            echo "<div class='desc'>";
                                echo "<p>" . $row['marca']  . "</p>";
                                echo "<h3>" . $row['name'] . "</h3>";
                                echo "<p class='price'>€".$row['costo']. "</p>";
                                echo "<a class='addToCart' href='#'>Aggiungi al carrello</a>"; 
                                echo "<input type='hidden' name='productId' value='" . $row['id'] . "'>";
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
                
        <div id="cartMenu">
    <h3>Carrello</h3>
    <p id='empty'>---Carrello vuoto---</p>
    <form action="order.php" method="POST">
        <ul id="cartItems">
            
        </ul>
        <div id="cartTotal">
            Totale: <span id="cartTotalValue">€0</span>
            <input type="hidden" name="totalCost" id="totalCostInput" value="0"> 
            <input type="hidden" name="productIds" id="productIdsInput" value="">    
        </div>
        <button id="confirmOrder" type="submit">Conferma ordine</button>
    
    </form>
</div>


        
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