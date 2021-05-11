<?php
	require_once "session.php";
	error_reporting (E_ALL ^ E_NOTICE);
?>

<!DOCTYPE html>
<html lang="en">

<script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>

<head>
    <meta charset="UTF-8">
    <title>Create a Class - Seat Deetz</title>
    <!-- For Nunito Sans font -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,wght@1,200&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="stylesForCreateClass.css?v=<?php echo time(); ?>">
	<link rel="icon" href="images/logofavicon.ico">
</head>

<body>
	<div class="main-container">
		<div class="back-button">
			<a href="classSelection.php" class="returnButton">
				<img border="0" alt="return" src="images/BACKBUTTON.png" width="40" height="30">
			</a>
		</div>
		<div class="header-container">
			<p class="header">CREATE A CLASS</p>
		</div>
	</div>

    <div class="container">
        <form class="row" action="insertClass.php" method="post">
			<div id="app">
				<div class="classNameFormSection">
					<input type="text" name="className" v-model="message" placeholder="Class Name" class="form-control" required>
				</div>

				<div class="colorFormSection">
					<p class = "colorPickerInstructionText">
						<b>Select Class Color:</b>
					</p>
					<input type = "color" name="classColor" v-model="color" class="colorPickerClassCreation">
				</div>

				<div id="capture" class="DemoClass" v-bind:style="{backgroundColor: color}">
					<p>{{ message }}</p>
				</div>
			</div>

			<div class="SubmitFormSection">
                <input class="newClassButton" type="submit" value="Create Class">
            </div>
        </form>
    </div>

	<script>
		var app = new Vue({
			el: '#app',
			data: {
				message: '',
				color: '#ccc'
			}
		})
	</script>

</body>
</html>
