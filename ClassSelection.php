<?php
require_once "session.php";
include "configImport.php";

?>
<!DOCTYPE html>
<html>

<head>
    <title>SeatDeetz</title>
    <!-- For Nunito Sans font -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,wght@1,200&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="stylesForClassSelect.css?v=<?php echo time(); ?>">
	<link rel="icon" href="images/logofavicon.ico">
    <style>
        body {
            background-color: #1C3E6A;
        }
    </style>

    <!-- JAVASCRIPT -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js" integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30=" crossorigin="anonymous"></script>
    <script>
    /*
    $("#form").validate({
    invalidHandler: function(event, validator) {
        // 'this' refers to the form
        var errors = validator.numberOfInvalids();
        if (errors) {
        var message = errors == 1
            ? 'Select a class before submitting.'
            //: 'You missed ' + errors + ' fields. They have been highlighted';
        $("div.error span").html(message);
        $("div.error").show();
        } else {
        $("div.error").hide();

        //$selectedClass = $('#class_name :selected').text();


        }
    }
    });*/

    /*
    --------------------------------------------------------------------------------------
    FUTURE USE : DYNAMIC BUTTONS
    --------------------------------------------------------------------------------------

    script type="text/javascript">
        var counter = 0; //

    	window.onload = function() {

    	//function displayUserClasses(id) { //THAT "(id)" SHOULD BE INSTRUCTOR ID
	  	//console.log("display class info fired " + id); //AGAIN "(id)" SHOULD BE INSTRUCTOR ID

	  	// SEND INSTRUCTOR ID TO SERVER AND QUERY FOR CLASS INFO
	  	$.ajax({
		  type : 'POST',
		  url : 'getClassInfo.php',
		  data : {'class_id_form' :$_SESSION['currentClass']},
		  success : function(data){
		    console.log("Instructor id sent successfully: " + $_SESSION['currentClass']);
		    console.log(data);
		    fillClassInfo(data);
		  }
		});

		}

		// GETS DATA FROM AJAX RESPONSE AND FILLS IN CLASS INFORMATION
		function fillClassInfo(data) {
		  var data_array = JSON.parse(data);
		  //document.getElementById("class-id").value = data_array.class_id_form;
     	  //document.getElementById("class-name-id").value = data_array.classname_form;

     	  //$k = data_array.class_id_form;
		  //$v = data_array.classname_form;
     	  //$btns= data_array;

		   $str = '';
		   $json = json_decode($str, TRUE);
		   $btns = $json[data_array.class_id_form][data_array.classname_form];

     	  while(($k,$v)=>each($btns[counter]) && counter != 9 && $btns[counter] !== NOT NULL){
      		  $str.='<input type="submit" value="'.$btns[data_array.class_id_form[counter]].'" name="btn_'.$btns[data_array.classname_form[counter]].'" id="btn_'.counter.'"/>';
        	  counter++;
	    	}
		return $str;
		}

   	    //check clicked button

		if(isset($_POST['btn_0']))
		{
			//Set UID = SESH VARIABLE and Output Class Name
  	    	header("Location: Dashboard.php");

			$k = $btns[data_array.class_id_form[counter]];

  	    	var new_class = '<?php echo $k; ?>';

    		$.ajax({
		  		type : 'POST',
		  		url : 'updateCurrentClass.php',
		  		data : {'current_class' :$_SESSION["currentClass"], 'class_id' : new_class},
		  		success : function(data){
     	  		}
			}
		}
		if(isset($_POST['btn_1']))
		{
			//Set UID = SESH VARIABLE and Output Class Name
    		header("Location: Dashboard.php");

			$k = $btns[data_array.class_id_form[counter]];

			var new_class = '<?php echo $k; ?>';

    		$.ajax({
		  		type : 'POST',
		  		url : 'updateCurrentClass.php',
		  		data : {'current_class' :$_SESSION["currentClass"], 'class_id' : new_class},
		  		success : function(data){
     	  		}
			}
		}
		if(isset($_POST['btn_2']))
		{
			//Set UID = SESH VARIABLE and Output Class Name
    		header("Location: Dashboard.php");

			$k = $btns[data_array.class_id_form[counter]];

			var new_class = '<?php echo $k; ?>';

    		$.ajax({
		  		type : 'POST',
		  		url : 'updateCurrentClass.php',
		  		data : {'current_class' :$_SESSION["currentClass"], 'class_id' : new_class},
		  		success : function(data){
     	  		}
			}
		}
		if(isset($_POST['btn_3']))
		{
			//Set UID = SESH VARIABLE and Output Class Name;
    		header("Location: Dashboard.php");

			$k = $btns[data_array.class_id_form[counter]];

			var new_class = '<?php echo $k; ?>';

    		$.ajax({
		  		type : 'POST',
		  		url : 'updateCurrentClass.php',
		  		data : {'current_class' :$_SESSION["currentClass"], 'class_id' : new_class},
		  		success : function(data){
     	  		}
			}
		}
		if(isset($_POST['btn_4']))
		{
			//Set UID = SESH VARIABLE and Output Class Name
    	header("Location: Dashboard.php");

		$k = $btns[data_array.class_id_form[counter]];

		var new_class = '<?php echo $k; ?>';

    		$.ajax({
		  		type : 'POST',
		  		url : 'updateCurrentClass.php',
		  		data : {'current_class' :$_SESSION["currentClass"], 'class_id' : new_class},
		  		success : function(data){
     	  		}
			}
		}
  		if(isset($_POST['btn_5']))
		{
			//Set UID = SESH VARIABLE and Output Class Name
    		header("Location: Dashboard.php");

			$k = $btns[data_array.class_id_form[counter]];

			var new_class = '<?php echo $k; ?>';

    		$.ajax({
		  		type : 'POST',
		  		url : 'updateCurrentClass.php',
		  		data : {'current_class' :$_SESSION["currentClass"], 'class_id' : new_class},
		  		success : function(data){
     	  		}
			}
		}
		if(isset($_POST['btn_6']))
		{
			//Set UID = SESH VARIABLE and Output Class Name
    		header("Location: Dashboard.php");

			$k = $btns[data_array.class_id_form[counter]];

			var new_class = '<?php echo $k; ?>';

    		$.ajax({
		  		type : 'POST',
		  		url : 'updateCurrentClass.php',
		  		data : {'current_class' :$_SESSION["currentClass"], 'class_id' : new_class},
		  		success : function(data){
     	  		}
			}
		}
		if(isset($_POST['btn_7']))
		{
			//Set UID = SESH VARIABLE and Output Class Name
    		header("Location: Dashboard.php");

			$k = $btns[data_array.class_id_form[counter]];

			var new_class = '<?php echo $k; ?>';

    		$.ajax({
		  		type : 'POST',
		  		url : 'updateCurrentClass.php',
		  		data : {'current_class' :$_SESSION["currentClass"], 'class_id' : new_class},
		  		success : function(data){
     	  		}
			}
		}
		if(isset($_POST['btn_8']))
		{
			//Set UID = SESH VARIABLE and Output Class Name;
    		header("Location: Dashboard.php");

			$k = $btns[data_array.class_id_form[counter]];

			var new_class = '<?php echo $k; ?>';

    		$.ajax({
		  		type : 'POST',
		  		url : 'updateCurrentClass.php',
		  		data : {'current_class' :$_SESSION["currentClass"], 'class_id' : new_class},
		  		success : function(data){
     	  		}
			}
		}
		if(isset($_POST['btn_9']))
		{
			//Set UID = SESH VARIABLE and Output Class Name
    		header("Location: Dashboard.php");

			$k = $btns[data_array.class_id_form[counter]];

			var new_class = '<?php echo $k; ?>';

    		$.ajax({
		  		type : 'POST',
		  		url : 'updateCurrentClass.php',
		  		data : {'current_class' :$_SESSION["currentClass"], 'class_id' : new_class},
		  		success : function(data){
     	  		}
			}
		}
    */

    if(isset($_POST['submit'])) {
        //var mySelect = document.getElementById("class_name");
        var selectedClass = $('#classes').children(":option").filter(':selected').text();
        //const select = document.getElementById("yourSelectId");
        //const selectedText = select.options[selectedIndex].text;
        //form.validate();
        $("#submit").click(function()){
            //dropdown validation
            if (selectedClass.value === ""){
                alert("You must select a Class!");
                return false;
            }
            else {
                <?php
                //$selectedClass = $('#classes').find(":selected").text();
                //const select = document.getElementById("yourSelectId");



                $sql = "SELECT class_id
                FROM classes
                WHERE instructor_id = '".$_SESSION['id']."' AND 'class_name' = '".$_SESSION['selectedClassName']."'";
                $result = mysqli_query($con, $sql) or die("Bad Query: $sql");

                while($rows = $result -> fetch_assoc()){
                    $_SESSION['current_class'] = $rows['class_id'];
                }
                ?>

                console.log("there is a value");
                return true;
                header(Dashboard.php);
            }
        }
    }
	</script>
</head>


<body>
  <div class="body-container">

    <div class="Title">
        <h1>CHOOSE CLASS</h1>
    </div>
    <div class="side-menu" id="userSettings">
        <a href="SideMenu.php"><img src="images/TRI-CIRCLES.png" height="35px" width="7.5px" alt="User Settings"></a>
    </div>

    <div class="dropDownMenu">

	<script>
		function unlock() {
			document.getElementById('buttonSubmit').removeAttribute("disabled");
		}
	</script>

    <form method="POST" action="Dashboard.php">
		<select id="classes" name="classes" onchange="unlock();">
			<option disabled selected>-- Select Class --</option>
			<?php

				$sql = "SELECT *
						FROM classes
						WHERE instructor_id = '".$_SESSION['id']."'";
				$result = mysqli_query($con, $sql) or die("Bad Query: $sql");

				while($rows = $result -> fetch_assoc()){
					$class_name = $rows['class_name'];
					echo "<option value = '$class_name'>$class_name</option>";
				}

				/*$num_results = mysqli_num_rows($result);
				for ($i=0;$i<$num_results;$i++) {
					$row = mysqli_fetch_array($result);
					$name = $row['name'];
					echo '<option value="' .$name. '">' .$name. '</option>';
				}*/

			?>
		</select>
		</div>

		<div class="btn">
    		<button type="submit" id="buttonSubmit" name="submit" disabled>Submit</button>
		</div>
	</form>

	<form method="post" action="createClass.php">
		<div class="addButton">
    		<button name="add">Add Class</button>
		</div>
	</form>

  </div>
</body>
