<?php

if (!isset($_GET["q"])) {
    echo "Non dovresti essere qui";
    exit;
}

header('Content-Type: application/json');

$conn = mysqli_connect("localhost", "root", "", "fuzerecords") or die(mysqli_error($conn));

$codfisc = mysqli_real_escape_string($conn, $_GET["q"]);

$query = "SELECT CD FROM accounts
                WHERE CD = '$codfisc'";

$res = mysqli_query($conn, $query) or die(mysqli_error($conn));

echo json_encode(array('exists' => mysqli_num_rows($res) > 0 ? true : false));

mysqli_close($conn);
?>