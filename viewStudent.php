<?php
require_once "session.php";
//require "config.php";
include "configImport.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>View Students - Seat Deetz</title>
    <!-- For Nunito Sans font -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,wght@1,200&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="stylesForStudent.css?v=<?php echo time(); ?>">
	<script>
		console.log(<?php echo $_SESSION["current_class"] ?>);
	</script>
	<link rel="icon" href="images/logofavicon.ico">
</head>

<body>
  <div class="title-container">
    <div class="back-button-container">
      <a href="Dashboard.php" class="returnButton">
        <img border="0" alt="return" src="images/BACKBUTTON.png" class="returnButton" width="40" height="30">
      </a>
    </div>
    <p class="header">Student List</p>
  </div>

<div class="container">
			<div class="newTable">
				<?php
					$sql = "SELECT * FROM studentinfo
							WHERE class_id = '".$_SESSION['current_class']."'";
					$result = mysqli_query($con, $sql) or die("Bad Query: $sql");

					echo"<table class='tableStyle'>";
					echo"<tr><td><b>First Name:</b></td><td><b>Last Name:</b></td><td><b>Action:</b></td></tr>";
					while($row = mysqli_fetch_assoc($result)) {
						echo
						"<tr>
							<td>{$row['student_first_name']}</td>
							<td>{$row['student_last_name']}</td>
							<td>
								<a href='deleteStudent.php?rn=$row[student_id]'>
									<img src='images/deleteBtn.png'
									alt='Remove Student from the Class.'
									width=28 height=28 border=0/>
								</a>

								<a href='editStudent.php?rn=$row[student_id]'>
									<img src='images/editBtn.png'
									alt='Edit Student Information.'
									width=28 height=28 border=0/>
								</a>
							</td>
						</tr>";
					}
					echo"</table>";
				?>
			</div>
            <div style="padding-top: 30px; padding-left: 50px; padding-bottom:20px; margin: 10px" class="buttonGroup">
				<div class="form-group">
					<ul>
						<li style="padding-right: 35px;">
							<a href="addStudent.php">
								<input type="button" class="listViewBtn" value="ADD STUDENT">
							</a>
						</li>
						<li>
						<script>
							function unlock() {
								document.getElementById('buttonSubmit').removeAttribute("disabled");
							}
						</script>
						<form method="post" action="fileUpload.php" enctype="multipart/form-data">
							<input type="file" onchange="unlock();" name="uploadFile" accept=".xlsx, .xls"/>
							<input type="submit" name="submit" id="buttonSubmit" class="importFileBtn" value="+ IMPORT FILE" disabled>
						</form>
						</li>
						<li>
							<form method="post" action="fileDownload.php">
								<input type="submit" name="submit" class="listViewBtn" value="EXPORT LIST" >
							</form>
						</li>
					</ul>
				</div>
			</div>
		    <div class="center">

			</div>
    </div>
</body>
</html>
