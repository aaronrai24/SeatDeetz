<?php
require_once "session.php";
include "configImport.php";
//implement buttons for premade 10 classes
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Class Edit</title>
    <link rel="icon" href="images/logofavicon.ico">
    <!-- For Nunito Sans font -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,wght@1,200&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="stylesForClassEdit.css?v=<?php echo time(); ?>" type="text/css">
</head>

<body>
  <div class="title-container">
    <div class="back-button-container">
      <a href="Dashboard.php" class="returnButton">
  		    <img border="0" class= "back-btn-container" alt="return" src="images/BACKBUTTON.png" width="40" height="30">
  	  </a>
      <p class="header">EDIT CLASS NAME</p>
    </div>
  </div>

    <div class="container">
        <form class="row" action="modifyEditedClass.php" method="post">
            <div class="form-group">
                <input type="text" name="classname" placeholder="Enter New Class Name" class="form-control" required>
                <span class="help-block"></span>
            </div>
            <!--
        		<span class="form-group">
        				<input type="text" name="starttime" placeholder="Class Starting Time" class="form-control" required>
                    <span class="help-block"></span>
            </span>
        		<div class="form-group">
                <input type="text" name="endtime" placeholder="Class Ending Time" class="form-control">
                    <span class="help-block"></span>
            </div>
          -->
            <div class="buttons">
                <div class="form-group">
                    	<input type="submit" class="editClass" value="SAVE">
				        </div>
            </div>
        </form>
    </div>
    <form method="post" action="deleteClass.php">
		  <div class="deleteButton">
    			<button name="delete">Delete Class</button>
		  </div>
	</form>
</body>
</html>
