<?php
session_start();
include "configImport.php";

$className = $_POST['className'];
$classColor = $_POST['classColor'];
$instructorID = $_SESSION['id'];

echo "console.log('$currentClass')";
$user_info = "INSERT INTO `classes`(`class_name`, `class_color`, `instructor_id`) VALUES ('$className', '$classColor', '$instructorID')";
$insertres=mysqli_query($con,$user_info);

header("Location: classSelection.php");
?>
