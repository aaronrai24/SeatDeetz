<?php
//Start the session
session_start();
//if user is not logged in, redirect to login
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php"); 
    exit;
}
else {
    //Check time when this page was loaded
    $now = time();
    if($now > $_SESSION['expire']) {
        session_destroy();
        echo "Your session has expired! <a href='login.php'>Login here</a>";
    }
}
?>