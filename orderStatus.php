<?php
    session_start();
    
?>

<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="orderStatus.css" />
    <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,300;0,400;1,200&display=swap" rel="stylesheet" />
    <title>Fuze Records</title>
</head>
<body>
    <header>
        <nav>
            <div class="UPLeft">
                <a id="logo1" href="homepage.php"><img src="Logo_mini.png" alt=""></a>
            </div>
        </nav>
    </header>
    <section>
    <div id='container'>
    <?php
    $status = $_GET['status'];

    if ($status === "success") {
        echo "Ordine effettuato con successo";

        // Connessione al database
        $conn = mysqli_connect("localhost", "root", "", "fuzerecords") or die(mysqli_error($conn));

        $username = $_SESSION["username"];
        $query1 = "SELECT id FROM accounts WHERE Username = '$username'";
        $result1 = $conn->query($query1);

        if ($result1->num_rows > 0) {
            $row1 = $result1->fetch_assoc();
            $accountId = $row1['id'];

            // Ottieni l'ultimo ordine dell'account
            $query = "SELECT * FROM orders WHERE accounts_id = $accountId ORDER BY order_id DESC LIMIT 1";
            $result = $conn->query($query);

            if ($result->num_rows > 0) {
                echo "<h2>Dettagli dell'ordine:</h2>";

                while ($row = $result->fetch_assoc()) {
                    //dettagli ordine
                    echo "<p>Numero ordine: " . $row['order_id'] . "</p>";
                    echo "<p>Totale: €" . $row['Cost_tot'] . "</p>";
                    echo "<p>Data creazione: " . date('d/m/Y', strtotime($row['created_at'])) . "</p>";

                    echo "<h3>Prodotti:</h3>";

                    $productIds = explode(",", $row['product_ids']);

                    $productQuery = "SELECT * FROM products WHERE id IN (" . implode(",", $productIds) . ")";
                    $productResult = $conn->query($productQuery);
                    

                    if ($productResult->num_rows > 0) {
                        while ($productRow = $productResult->fetch_assoc()) {
                            echo "<div class='product'>";
                            echo '<img src="' . $productRow['img'] . '" alt="' . $productRow['name'] . '" />';
                            echo "<div class='desc'>";
                            echo "<p>" . $productRow['name'] . "</p>";
                            
                            echo "<p>Prezzo: €" . $productRow['costo'] . "</p>";
                            echo "</div>";
                            echo "</div>";
                           
                        }
                    } else {
                        echo "Nessun prodotto trovato per questo ordine.";
                    }
                    
                }
            } else {
                echo "Nessun ordine trovato.";
            }

            $conn->close();

        } else {
            echo "Nessun ordine trovato.";
        }
    } else {
        echo "Errore durante il salvataggio dell'ordine";
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
