<?php
session_start();

$conn = mysqli_connect("localhost", "root", "", "fuzerecords") or die(mysqli_error($connection));

if (!empty($_POST["totalCost"]) && !empty($_POST["productIds"])) {
    $costoTotale = $_POST["totalCost"];
    $idProdottiStringa = $_POST["productIds"];

    $username = $_SESSION["username"];
    $query = "SELECT a.id, p.domicilio FROM accounts a JOIN people p ON a.CF = p.CF WHERE a.Username = '$username'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $idAccount = $row['id'];
    $dom = $row['domicilio'];

    // Inserimento dell'ordine nel database
    $query2 = "INSERT INTO `orders` (`accounts_id`, `product_ids`, `Cost_tot`, `indirizzo`) VALUES ('$idAccount', '$idProdottiStringa', '$costoTotale', '$dom')";
    if (mysqli_query($conn, $query2)) {
        header("Location: orderStatus.php?status=success");

    } else {
       header("Location: orderStatus.php?status=error");
    }
}

mysqli_close($conn);
?>
