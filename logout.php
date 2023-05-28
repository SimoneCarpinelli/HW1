<?php
// Avvia la sessione
session_start();

// Elimina la sessione
session_destroy();

if (isset($_COOKIE['user_id']) && isset($_COOKIE['token']) && isset($_COOKIE['cookie_id'])) {
    $conn = mysqli_connect("localhost", "root", "", "fuzerecords") or die(mysqli_error($conn));
    $cookieid = mysqli_real_escape_string($conn, $_COOKIE['cookie_id']);
    $userid = mysqli_real_escape_string($conn, $_COOKIE['user_id']);
    $res = mysqli_query($conn, "SELECT id, hash FROM cookie WHERE id = $cookieid AND user_id = $userid");
    if ($cookie = mysqli_fetch_assoc($res)) {
        if (password_verify($_COOKIE['token'], $cookie['hash'])) {
            mysqli_query($conn, "DELETE FROM cookie WHERE id = $cookieid");
            mysqli_close($conn);
            setcookie('user_id', '', time() - 3600);
            setcookie('cookie_id', '', time() - 3600);
            setcookie('token', '', time() - 3600);
        }
    }
}

header("Location: homepage.php");
exit;
?>
