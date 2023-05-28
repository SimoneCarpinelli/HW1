<?php


if (!isset($_GET["q"])) {
    echo "Non dovresti essere qui";
    exit;
}

header('Content-Type: application/json');

$conn = mysqli_connect('localhost','root','','fuzerecords');

$telefono = mysqli_real_escape_string($conn, $_GET["q"]);

$query = "SELECT telefono FROM consulenza
                WHERE telefono = '$telefono'";

$res = mysqli_query($conn, $query) or die(mysqli_error($conn));

echo json_encode(array('exists' => mysqli_num_rows($res) > 0 ? true : false));

mysqli_close($conn);
?>