<?php
//Start the session
session_start();
//if user is logged in, redirect to welcome page for now(replace with class selection)
if(isset($_SESSION["userid"]) && $_SESSION["userid"] === true) {
    header("location: welcome.php"); //<----Change to whatever(Should be classSelect.php)
    exit();
}
?>