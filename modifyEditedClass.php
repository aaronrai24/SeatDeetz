<?php
//include "configClassEdit.php";
include "configImport.php";
session_start();

$className = $_POST["classname"];
//$startTime = $_POST["starttime"];
//$endTime = $_POST["endtime"];
$id = $_SESSION["current_class"];

    //Check for empty fields
    if(!empty($className)) {
        $query = "UPDATE classes SET class_name= '$className' WHERE class_id = '$id'";
        $insertres=mysqli_query($con,$query);
    }
    //header($_POST["classname"]);
    header("Location: classSelection.php");
?>
