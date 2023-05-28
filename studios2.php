<?php
    session_start();
    
?>

<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="studios.css" />
    <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,300;0,400;1,200&display=swap" rel="stylesheet" />
    <title>Fuze Records</title>
</head>
<body>
    <header>
    <nav>
            <div class="UPLeft">
                <div class="logo">
                    <a id="logo1" href="homepage2.php"><img src="Logo_mini.png" alt=""></a>
                </div>
                <div class="link">
                    <a href="">Producers</a>
                    <a href="prodotti2.php">Prodotti</a>
                </div>
            </div>
            <div>
                <a class="buttons" href="logout.php">Log-out</a>
            </div>
            
        </nav>
    </header>
    <section>
    <?php
        // Connessione al database
        $conn = mysqli_connect("localhost", "root", "", "fuzerecords") or die(mysqli_error($conn));

        $query = "SELECT * FROM studios";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {

            while ($row = mysqli_fetch_assoc($result)) {
                $nome = $row['nome'];
                $indirizzo = $row['indirizzo'];
                $img = $row['img'];

                // Visualizza i valori nella pagina
                echo "<div>";
                echo "<img src='$img' alt='$nome'>";
                echo "<div class='details'>";
                echo "<h3>$nome</h3>";
                echo "<p>$indirizzo</p>";
                echo "</div>";
                echo "</div>";
            }
        } else {
            echo "Nessun risultato trovato";
        }

        mysqli_close($conn);
    ?>

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
