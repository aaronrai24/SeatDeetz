<?php
require_once "session.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Add a Student - Seat Deetz</title>
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
        <p class="header">ADD A STUDENT</p>
        <form class="row" action="insertStudent.php" method="post">
            <div class="form-group">
                <input type="text" name="firstName" placeholder="Student First Name" class="form-control" required>
                <span class="help-block"></span>
            </div>
            <div class="form-group">
                <input type="text" name="lastName" placeholder="Student Last Name" class="form-control" required>
                <span class="help-block"></span>
            </div>
			<div class="form-group">
                <input type="text" name="nickName" placeholder="Student Nickname" class="form-control">
                <span class="help-block"></span>
            </div>
			<div class="form-group">
                <input type="date" name="birthday" placeholder="Student Birthday" onfocus="(this.type='date')" class="form-control" required>
                <span class="help-block"></span>
            </div>
            <div class="buttons">
                <div class="newButton">
                    	<input type="submit" class="addBtn" value="Add Student">
                </div>
            </div>
        </form>
    </div>
</body>
</html>
