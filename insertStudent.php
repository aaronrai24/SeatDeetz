<?php
session_start();
include "configImport.php";

$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$nickName = $_POST['nickName'];
$birthday = $_POST['birthday'];
echo $_SESSION['current_class'];
$currentClass = $_SESSION['current_class'];
echo "console.log('$currentClass')";
    //Check if fields are empty, if not insert them into DB
    // JP - temporarily made it so that class id = 1 for testing purposes
    if(!empty($firstName) || !empty($lastName) || !empty($nickName) || !empty($birthday)) {
        $user_info = "INSERT INTO `studentinfo`(`student_first_name`, `student_last_name`, `nickname`, `birthday`, `class_id`) 
                      VALUES ('$firstName','$lastName', '$nickName', '$birthday', '$currentClass')";
        $insertres=mysqli_query($con,$user_info);
    }
    header("Location: viewStudent.php");//<--Redirect
?>
