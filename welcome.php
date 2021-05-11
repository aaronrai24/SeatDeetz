<?php
//This page is just temporary please resort to login.php and change the location the the right class file

//Include this php snippet in the class selection screen please
//start session
session_start();
//check if user is not logged in and send back to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Welcome <?php echo $_SESSION["name"];?></title>
    </head>
    <body>
        <h1>Hello, <?php echo $_SESSION["username"];?> this page is just temporary</h1>
        <p><a href="logout.php" class="logoutbtn" role="button" aria-pressed="true">Log Out</a></p>
        <p><a href="resetPassword.php" class="logoutbtn" role="button" aria-pressed="true">Change Password</a></p>
    </body>
</html>
