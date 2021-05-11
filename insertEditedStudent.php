<?php
//!empty($firstName) && !empty($lastName) && !empty($nickName) && !empty($birthday)
include "configImport.php";
session_start();

$firstName = $_POST["firstName"];
$lastName = $_POST["lastName"];
$nickName = $_POST["nickName"];
$birthday = $_POST["birthday"];
$id = $_SESSION['id'];

    //Default case (if all fields are filled)
    if(!empty($firstName) && !empty($lastName) && !empty($birthday) && !empty($nickName)) {
        $query = "UPDATE studentinfo SET student_first_name= '$firstName', student_last_name= '$lastName', nickname= '$nickName', birthday= '$birthday' WHERE student_id = '$id'";
        $insertres=mysqli_query($con,$query);
    }
    //Check if 3 variables are empty first 
    else if(empty($firstName) && empty($lastName) && empty($birthday)) {
        $query = "UPDATE studentinfo SET nickname= '$nickName' WHERE student_id = '$id'";
        $insertres=mysqli_query($con,$query);
    }
    else if(empty($lastName) && empty($birthday) && empty($nickName)) {
        $query = "UPDATE studentinfo SET student_first_name= '$firstName' WHERE student_id = '$id'";
        $insertres=mysqli_query($con,$query);
    }
    else if(empty($firstName) && empty($birthday) && empty($nickName)) {
        $query = "UPDATE studentinfo SET student_last_name= '$lastName' WHERE student_id = '$id'";
        $insertres=mysqli_query($con,$query);
    }
    else if(empty($firstName) && empty($lastName) && empty($nickName)) {
        $query = "UPDATE studentinfo SET birthday= '$birthday' WHERE student_id = '$id'";
        $insertres=mysqli_query($con,$query);
    }
    //check if two variables are empty
    else if(empty($firstName) && empty($lastName)) {
        $query = "UPDATE studentinfo SET nickname= '$nickName', birthday= '$birthday' WHERE student_id = '$id'";
        $insertres=mysqli_query($con,$query);
    }
    else if(empty($firstName) && empty($nickName)) {
        $query = "UPDATE studentinfo SET student_last_name= '$lastName', birthday= '$birthday' WHERE student_id = '$id'";
        $insertres=mysqli_query($con,$query);
    }
    else if(empty($firstName) && empty($birthday)) {
        $query = "UPDATE studentinfo SET student_last_name= '$lastName', nickname= '$nickName' WHERE student_id = '$id'";
        $insertres=mysqli_query($con,$query);
    }
    else if(empty($lastName) && empty($nickName)) {
        $query = "UPDATE studentinfo SET student_first_name= '$firstName', birthday= '$birthday' WHERE student_id = '$id'";
        $insertres=mysqli_query($con,$query);
    }
    else if(empty($lastName) && empty($birthday)) {
        $query = "UPDATE studentinfo SET student_first_name= '$firstName', nickname= '$nickName' WHERE student_id = '$id'";
        $insertres=mysqli_query($con,$query);
    }
    else if(empty($nickName) && empty($birthday)) {
        $query = "UPDATE studentinfo SET student_first_name= '$firstName', student_last_name= '$lastName' WHERE student_id = '$id'";
        $insertres=mysqli_query($con,$query);
    }
    //Check if one variable is empty
    else if(empty($firstName)) {
        $query = "UPDATE studentinfo SET student_last_name= '$lastName', nickname= '$nickName', birthday= '$birthday' WHERE student_id = '$id'";
        $insertres=mysqli_query($con,$query);
    }
    else if(empty($lastName)) {
        $query = "UPDATE studentinfo SET student_first_name= '$firstName', nickname= '$nickName', birthday= '$birthday' WHERE student_id = '$id'";
        $insertres=mysqli_query($con,$query);
    }
    else if(empty($nickName)) {
        $query = "UPDATE studentinfo SET student_first_name= '$firstName', student_last_name= '$lastName', birthday= '$birthday' WHERE student_id = '$id'";
        $insertres=mysqli_query($con,$query);
    }
    else if(empty($birthday)) {
        $query = "UPDATE studentinfo SET student_first_name= '$firstName', student_last_name= '$lastName', nickname= '$nickName' WHERE student_id = '$id'";
        $insertres=mysqli_query($con,$query);
    }
    else {
        echo "error";
    }
    
    header("Location: viewStudent.php");
?>