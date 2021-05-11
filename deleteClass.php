<?php
include "configImport.php";
session_start();
error_reporting(0);

	$classId = $_SESSION["current_class"];
	
	$deleteSeat = "DELETE FROM `seatingchart` WHERE `class_id` = '$classId'";
	$deleteStud = "DELETE FROM `studentinfo` WHERE `class_id` = '$classId'";
	$deleteSql = "DELETE FROM `classes` WHERE `class_id` = '$classId'";
	
	$dataThree = mysqli_query($con, $deleteSeat) or die("Bad Query: $deleteSeat");
	$dataTwo = mysqli_query($con, $deleteStud) or die("Bad Query: $deleteStud");
	$data = mysqli_query($con, $deleteSql) or die("Bad Query: $deleteSql");

	header("Location: classSelection.php");
?>