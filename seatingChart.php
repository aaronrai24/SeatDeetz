<?php
error_reporting (E_ALL ^ E_NOTICE);
require_once "session.php";
require_once "config.php";
include "getStudentInfo.php";
?>


<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Seating Chart</title>
    <link rel="stylesheet" href="stylesForSeating.css">
    <link rel="icon" href="images/logofavicon.ico">
    <!-- For Nunito Sans font -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,wght@1,200&display=swap" rel="stylesheet">

    <!-- JAVASCRIPT -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js" integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30=" crossorigin="anonymous">
    </script>
	<script src="scripts/html2canvas.min.js"></script>

    <script type="text/javascript">
        var counter = 0;

        /*
        On page load, get all the students in seatingChart db table and display them on the screen.
        - For each result, create a seat, set id to student_id
        - Set style top and left to parent's coordinates + db values
        - Append first name on the seating object.
        - Set ID to student_id for easy access
        */
        window.onload = function() {
          /*
          Get $('#seating-chart-interactive-id').position(); and subtract from student seat position
          and save that number in the db
          When getting coordinates from the DB, get container position, and add onto coordinates
          */
          var container_left = $('#seating-chart-interactive-id').position().left;
          var container_top = $('#seating-chart-interactive-id').position().top;


          //Eventually change to where class_id = current class id
          <?php
          $sql = "SELECT sc.class_id, sc.student_id, sc.left_position, sc.top_position,
                  si.student_first_name, si.student_last_name, si.nickname, si.notes
                  FROM seatingChart sc
                  INNER JOIN studentInfo si
                  on sc.student_id = si.student_id
                  WHERE sc.class_id = '".$_SESSION['current_class']."'";
          $result = mysqli_query($link, $sql) or die("Bad Query: $sql");
          while($row = mysqli_fetch_assoc($result)) {

            $fname = $row['student_first_name'];
            $lname = $row['student_last_name'];
            $nickname = $row['nickname'];
            $notes = $row['notes'];
            $class_id = $row['class_id'];
            $student_id = $row['student_id'];
            $left_position = $row['left_position'];
            $top_position = $row['top_position'];

            echo "
            //Create seat div
            var newSeatDiv = document.createElement('div');
            newSeatDiv.setAttribute('class', 'seat-container');
            newSeatDiv.setAttribute('id', $student_id);
            document.getElementById('seating-chart-interactive-id').appendChild(newSeatDiv);

            $('.seat-container').draggable({
                containment: 'parent'
            });

            //Position of student seat based on relative parent container coordinates
            var relative_left_position = $left_position + container_left;
            var relative_top_position = $top_position + container_top;

            document.getElementById($student_id).style.left = relative_left_position + 'px';
            document.getElementById($student_id).style.top = relative_top_position + 'px';

            //Create button on seat div to pull up Student Information
            var newSeatObj = document.createElement('BUTTON');
            newSeatObj.setAttribute('class', 'seat-object-btn');
            newSeatObj.setAttribute('onclick', '');
            document.getElementById($student_id).appendChild(newSeatObj);

            //Create div that contains student first name or nickname
            var newSeatLabel = document.createElement('div');
            newSeatLabel.setAttribute('class', 'seat-object-student-name');
            ";
            //If student has a nickname, display, else display first name
            if(empty($nickname)){
              echo "newSeatLabel.innerHTML = '$fname';";
            }
            else {
              echo "newSeatLabel.innerHTML = '$nickname';";
            }
            echo "document.getElementById($student_id).appendChild(newSeatLabel);";

          } //End of result set while loop
          ?>
        }

        /*
        When save button is clicked, all seat container elements will have their top and left positions
        updated in the db.  Take current positions and subtract the relative container position, store
        those calculated values in the db.
        */
        function saveSeatPositions() {
          //Get current coordinates of seating chart container_top
          var container_left = $('#seating-chart-interactive-id').position().left;
          var container_top = $('#seating-chart-interactive-id').position().top;
          //Get all seat-container elements
          var listOfAllSeats = document.getElementsByClassName("seat-container");
          for (var i = 0; i < listOfAllSeats.length; i++) {
              var studentid = listOfAllSeats[i].id;
              //This is the coordinates of the seats relative to the container
              var relative_left_position = listOfAllSeats[i].offsetLeft - container_left;
              var relative_top_position = listOfAllSeats[i].offsetTop - container_top;
              console.log(studentid);
              //Update seatingChart table in the database with these new values
              $.ajax({
                type : 'POST',
                url : 'updateSeatingChart.php',
                data : {'id':studentid, 'left':relative_left_position, 'top':relative_top_position},
                success : function(data){}
              });

          }
        }

        /*
        This will create a new div for the seat object, append a button to it, and append the div to
        the seating chart container
        */
        function addSeat() {
            var newSeatDiv = document.createElement("div");
            newSeatDiv.setAttribute("class", "seat-container");
            newSeatDiv.setAttribute("id", "seat-container-id-" + counter);
            document.getElementById("seating-chart-interactive-id").appendChild(newSeatDiv);

            var newSeatObj = document.createElement("BUTTON");
            newSeatObj.setAttribute("class", "seat-object-btn");
            newSeatObj.setAttribute("id", "seat-object-btn-" + counter);
            newSeatObj.setAttribute("onclick", "createStudentInfoForm()");
            document.getElementById("seat-container-id-" + counter).appendChild(newSeatObj);
            counter++;

            $(".seat-container").draggable({
                containment: "parent"
            });
        }

        /* Clicking the lock button will disable draggable divs */
        function lock() {
            /* LOCK SEATS */
            if (document.getElementById("lock-caption-id").innerHTML == "LOCK") {
                document.getElementById("lock-img-id").src = "images/UNLOCKED_WHITE.png";
                document.getElementById("lock-caption-id").innerHTML = "UNLOCK";
                $(".seat-container").draggable("disable");
                $(".add-seat-btn").prop("disabled", true);
            }
            /* UNLOCK SEATS */
            else {
                document.getElementById("lock-img-id").src = "images/LOCKED_RED.png";
                document.getElementById("lock-caption-id").innerHTML = "LOCK";
                $(".seat-container").draggable("enable");
                $(".add-seat-btn").prop("disabled", false);
            }
        }

        /* This function will delete all records associated with selected seat */
        function deleteSeat() {
            alert("Delete seat button clicked;");
        }

          /*
         This function will take the id value, retrieve studentInfo from database
         and fill in and display the student information fields on the page
         */
         function displayStudentInfo(id) {
           console.log("display student info fired " + id);
           // Send student ID to server and query for student information
           $.ajax({
             type : 'POST',
             url : 'getStudentInfo.php',
             data : {'student_id_form':id},
             success : function(data){
               console.log("id sent successfully: " + id);
               console.log(data);
               fillStudentInfo(data);
             }
           });

           makeStudentInfoVisible();
         }

        // Gets data from AJAX response and fills in student information form
         function fillStudentInfo(data) {
           var data_array = JSON.parse(data);
           document.getElementById("first-name-input-id").value = data_array.fname_form;
           document.getElementById("last-name-input-id").value = data_array.lname_form;
           document.getElementById("nickname-input-id").value = data_array.nickname_form;
           document.getElementById("birthday-input-id").value = data_array.birthday_form;
           document.getElementById("notes-input-id").value = data_array.notes_form;

         }

         function makeStudentInfoVisible() {
           document.getElementById("student-information-title-id").setAttribute("style", "visibility:visible;");
           document.getElementById("student-information-container-id").setAttribute("style", "visibility:visible;");
         }

         function makeStudentInfoHidden() {
           document.getElementById("student-information-title-id").setAttribute("style", "visibility:hidden;");
           document.getElementById("student-information-container-id").setAttribute("style", "visibility:hidden;");
         }

        function showStudentInfo() {
            //If student information header is visible, then change to hidden
            if ($("#student-information-title-id").css("visibility") == "visible") {
                makeStudentInfoHidden();
            } else {
                makeStudentInfoVisible();
            }

        }

        //Jquery functions
        $(document).ready(function() {

          //Global Variable for Student ID
          var studentid;

            // When Assignments dropdown is selected on the main container, set the Student Information dropdown to same value
            $("#assignment-dropdown-id").change(function() {
                var selectedItem = $("#assignment-dropdown-id").val();
                var listOfAllAssignmentDropdowns = document.getElementsByClassName("assignment-dropdown");
                for (var i = 0; i < listOfAllAssignmentDropdowns.length; i++) {
                    listOfAllAssignmentDropdowns[i].value = selectedItem;
                }
            });

            // When seat button is clicked, get container id (student id ) and display student info
            $(document).on('click', '.seat-object-btn', function() {
                studentid = $(this).parent().attr('id');
                console.log("seat button clicked " + studentid);
                displayStudentInfo(studentid);
            });

            // When student info submit button is clicked, send student id to updateStudentInfo
            $(document).on('click', '#submit-btn', function() {
                console.log("submit button clicked " + studentid);
                $.ajax({
                  type : 'POST',
                  url : 'updateStudentInfo.php',
                  data : $('#student-infomation-form-id').serialize() + "&id=" + studentid,
                  success : function(data){
                    $('#student-infomation-form-id').submit();
                  }
                });
            });
        });
    </script>
</head>

<body>
    <div class="main-container" id="main-container-id">
        <div class="header-seating-chart">
            <div class="back-button-container">
                <a href="Dashboard.php">
                    <img src="images/BACKBUTTON.png" alt="back-button" class="back-btn">
                </a>
            </div>
            <div class="seating-chart-title-container">
                <h1 class="seating-chart-title"><em>SEATING CHART</em></h1>
            </div>
        </div>
        <!-- Contains the main seating chart and associated buttons-->
        <div class="seating-chart-container">
            <div class="seating-chart-top">
                <button type="button" class="btn select-template-btn" href="">SELECT TEMPLATES</button>
                <!--<select class="assignment-dropdown-main" id="assignment-dropdown-id" name="">
            <option value="0"selected>Select Assignment:</option>
            <option value="1">Test 1: A Very Long Assignment Name Here</option>
            <option value="2">Test 2</option>
          </select>-->
            </div>
            <div class="seating-chart-interactive" id="seating-chart-interactive-id">

            </div>
            <div class="seating-chart-bottom">
                <!-- add a new element into the seating-chart-interactive container -->
                <!-- not needed due to add student capability on student list page -->
                <!--<button type="button" class="btn add-seat-btn" onclick= "addSeat()" id="add-seat-btn">+ ADD SEAT</button>-->
                <!-- TEMPORARY BUTTON TO DISPLAY STUDENT INFORMATION FORM
                <button type="button" class="btn show-student-btn" onclick="showStudentInfo()" href="">STUDENT INFO</button>-->
                <button type="button" class="btn save-chart-btn" onclick="saveSeatPositions()">SAVE CHART</button>
                <button type="button" id="export" class="btn export-chart-btn" href="">EXPORT</button>
                <div class="lock-container">
                    <img src="images/LOCKED_RED.png" class="lock-img" id="lock-img-id" alt="red-lock-img" onclick="lock()">
                    <div class="lock-caption" id="lock-caption-id">LOCK</div>
                </div>

            </div>
        </div>
        <div class="right-container">
            <img src="images/logowithtitle.png" alt="seatdeetz-logo-img" class="seatdeetz-logo-background">
            <!-- After selecting a student, the student information form will appear in this div -->
            <div class="header-student-information">
                <h1 class="student-information-title" id="student-information-title-id">STUDENT INFORMATION<span onclick="makeStudentInfoHidden()">  </span></h1>
            </div>
            <!-- STUDENT INFORMATION FORM -->
            <form class="student-information-form" id="student-infomation-form-id"action="updateStudentInfo.php" method="post">
                <div class="student-information-container" id="student-information-container-id">
                    <!-- Student First Name Input -->
                    <div class="student-information-container-row">
                        <div class="student-information-label">
                            <label class="input-label">FIRST NAME</label>
                        </div>
                        <div class="student-information-input">
                            <input class="name-input" id="first-name-input-id" type="text" name="first-name" maxlength="20" value="">
                        </div>
                    </div>
                    <!-- Student Last Name Input -->
                    <div class="student-information-container-row">
                        <div class="student-information-label">
                            <label class="input-label">LAST NAME</label>
                        </div>
                        <div class="student-information-input">
                            <input class="name-input" id="last-name-input-id" type="text" name="last-name" maxlength="20" value="">
                        </div>
                    </div>
                    <!-- Nickname input -->
                    <div class="student-information-container-row">
                        <div class="student-information-label">
                            <label class="input-label">NICKNAME</label>
                        </div>
                        <div class="student-information-input">
                            <input class="name-input" id="nickname-input-id" type="text" name="nickname" maxlength="20" value="">
                        </div>
                    </div>
                    <!-- HIDDEN FOR FUTURE DEVELOPMENT  - Assignment Selection
                    <div class="student-information-container-row" id="assignment-container-id">
                        <div class="student-information-label">
                            <label class="input-label">ASSIGNMENT</label>
                        </div>
                        <div class="student-information-input">
                            <select class="assignment-dropdown name-input" name="assignment-name">
                              <option value="0">Select Assignment:</option>
                              <option value="1">Test 1: A Very Long Assignment Name Here</option>
                              <option value="2">Test 2</option>
                            </select>
                            <input class="assignment-grade-input" type="text" name="assignment-grade" value="100">
                        </div>
                    </div>
                    -->
                    <!-- Birthday input -->
                    <div class="student-information-container-row">
                        <div class="student-information-label">
                            <label class="input-label">BIRTHDAY</label>
                        </div>
                        <div class="student-information-input">
                            <input class="birthday-input" id="birthday-input-id" type="date" name="birthday" value="">
                        </div>
                    </div>
                    <div class="additional-information-container">
                        <label class="input-label">ADDITIONAL INFORMATION</label>
                        <br>
                        <textarea class="additional-information-textbox" id="notes-input-id" name="student-notes" rows="7" cols="45"></textarea>
                        <input class="btn" type="button" value="SAVE" id="submit-btn" style="margin: 15px 110px;">
                        <button type="button" class="btn" id="cancel-btn" onclick="makeStudentInfoHidden()" style="margin:0px 110px 25px 110px;">
                          CANCEL
                        </button>
                    <!--DROP STUDENT BUTTON (May be optional)
                        <button type="button" class="btn" id="delete-seat-btn" onclick="deleteSeat()" href="" style="margin:20px 110px 25px 110px;">
                          - DROP STUDENT
                        </button>
                    -->
                    </div>
                </div>
            </form>

        </div>

    </div>
</body>

<script>
	document.getElementById("export").addEventListener("click", function()
	{
		//Creates a Canvas and binds the DIV with the id = 'Outer' to the new Canvas.
		html2canvas(document.querySelector('#seating-chart-interactive-id')).then(function(canvas)
		{
			var d = new Date();
            saveAs(canvas.toDataURL(), 'Seating Chart (' + (d.getMonth() + 1) +
									   '-' + d.getDay() +
									   '-' + d.getFullYear() +
									   ').png');
			//Binds the Base64 string to the file name we created.
		});
	});

	function saveAs(uri, filename)
	{
		//Creates a invisible link.
		var invisLink = document.createElement('a');

		if (typeof invisLink.download == 'string')
		{
			//Points the link on the page to our Base64 string.
			invisLink.href = uri;

			//Since the image can be downloaded, the download name is the filename.
			invisLink.download = filename;

			//Adds the link to the webapp.
			document.body.appendChild(invisLink);

			//The script clicks the link.
			invisLink.click();

			//The link is removed from the page.
			document.body.removeChild(invisLink);
		}

		else
		{
			//If the image can't be downloaded, open a new browswer window
			//and display the image there.
			window.open(uri);
		}
	}
</script>

</html>
