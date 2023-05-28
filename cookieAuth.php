<?php


function checkAuth(){
    if(!isset($_SESSION['user_id'])){
        if(isset($_COOKIE['user_id']) && isset($_COOKIE['token']) && isset($_COOKIE['cookie_id'])){
            $conn = mysqli_connect("localhost", "root", "", "fuzerecords") or die(mysqli_error($conn));
            $cookieid = $_COOKIE['cookie_id'];
            $userid = $_COOKIE['user_id'];

            $res = mysqli_query($conn, "SELECT * FROM cookie where id = $cookieid AND user_id = $userid");
            $cookie = mysqli_fetch_assoc($res);
            if($cookie){
                if(time() > $cookie['expires']) {
                    mysqli_query($conn, "DELETE FROM cookie where id = ".$cookie['id']) or die(msqli_error($conn));
                    header('Location: logout.php');
                    exit;
                }else if(password_verify($_COOKIE['token'], $cookie['hash'])){
                    $_SESSION['user_id'] = $_COOKIE['user_id'];
                    mysqli_close($conn);
                    return $_SESSION['user_id'];
                }  
            }
        }
    }else{
        return $_SESSION['user_id'];
    }
}
?>