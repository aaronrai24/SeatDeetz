<?php
include "configImport.php";
require_once "session.php";
error_reporting(0);
session_start();

$_SESSION['id'] = $_GET['rn'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit a Student - Seat Deetz</title>
		<!-- For Nunito Sans font -->
		<link rel="preconnect" href="https://fonts.gstatic.com">
		<link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,wght@1,200&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="stylesForStudent.css?v=<?php echo time(); ?>">
    <link rel="icon" href="images/logofavicon.ico">
</head>

<body>
	<a href="viewStudent.php" class="returnButton">
		<img border="0" alt="return" src="images/BACKBUTTON.png" width="40" height="25">
	</a>
    <div class="container">
        <p class="header">EDIT A STUDENT</p>
        <form class="row" action="insertEditedStudent.php" method="post">
            <div class="form-group">
                <input type="text" name="firstName" placeholder="First Name" class="form-control">
                <span class="help-block"></span>
            </div>
			<span class="form-group">
				<input type="text" name="lastName" placeholder="Last Name" class="form-control">
                <span class="help-block"></span>
            </span>
			<div class="form-group">
                <input type="text" name="nickName" placeholder="Nickname" class="form-control">
                <span class="help-block"></span>
            </div>
			<div class="form-group">
                <input type="date" name="birthday" placeholder="Birthday" class="form-control">
                <span class="help-block"></span>
            </div>
            <div class="buttons">
                <div class="form-group">
                    	<input type="submit" class="addBtn" value="Edit Student">
                </div>
            </div>
        </form>
    </div>
</body>
</html>
