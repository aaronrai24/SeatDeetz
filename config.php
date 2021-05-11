<?php 
define('DBSERVER', 'localhost'); //Database Server
define('DBUSERNAME', 'root'); //Database username
define('DBPASSWORD', ''); //Database Password
define('DBNAME', 'users'); //Database name

//Connect to Database
$link = mysqli_connect(DBSERVER,DBUSERNAME,DBPASSWORD,DBNAME);

//Check connection
if($link === false) {
    die("Error: Connection error. " . mysqli_connect_error());
}
?>