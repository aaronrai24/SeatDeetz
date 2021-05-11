<?php
require_once "config.php";
require_once "session.php";
?>
<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <link rel="preconnect" href="https://fonts.gstatic.com/%22%3E">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300&display=swap" rel="stylesheet">
    <title>Dashboard</title>
    <link href="stylesForDash.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css">
    <link rel="icon" href="images/logofavicon.ico">

    <script>
    <?php

    if(isset($_POST['submit'])) {
        //var mySelect = document.getElementById("class_name");
        $selectedClass = $_POST["classes"];
        echo "console.log('$selectedClass')";
        //const select = document.getElementById("yourSelectId");
        //const selectedText = select.options[selectedIndex].text;
        //form.validate();
      
                
                //$selectedClass = $('#classes').find(":selected").text();
                //const select = document.getElementById("yourSelectId");

                

                $sql = "SELECT class_id
                FROM classes
                WHERE instructor_id = '".$_SESSION['id']."' AND class_name = '$selectedClass'";
                $result = mysqli_query($link, $sql) or die("Bad Query: $sql");

                while($rows = $result -> fetch_assoc()){
                    $_SESSION['current_class'] = $rows['class_id'];
                }
                    $_SESSION['class_name'] = $selectedClass;
                
        }
    ?>
    console.log(<?php echo $_SESSION["current_class"] ?>);


    </script>
</head>


<body>
    <div class="container" style="text-align: center;">
        <!---For Two Top Menus and Dashboard Display--->
        <h1>
            <!--- Replace below line with link to home page--->
            <a href="ClassSelection.php">
              <div class="back-button">
                <img align="left" width="40" height="30" src="images/BACKBUTTON.png" alt="back button" title="To Class Menu" />
              </div>
            </a>
            <!--- Replace below line with link to sidebar stuff--->
            <a href="SideMenu.php">
                <img align="right" width="10" height="40" src="images/TRI-CIRCLES.png" alt="to sidebar" title="To Signout" />
            </a>
            <p style="text-align: center; color: white"> Dashboard</p>
        </h1>
    </div>
    <hr/>
    <div class="name-container">
      <p class="UserTop" style="text-align: center; color: white;">
                <?php   echo $_SESSION["firstName"];
                        echo " ";
                        echo $_SESSION["lastName"];
                ?>
      </p>
    </div>
    <div class="className-container">
        <p class="ClassTop" style="text-align: center; color: red;">
          <?php echo "Selected Class: ";
                echo $_SESSION['class_name'];
          ?>
        </p>
    </div>
    <div class="class-edit-container">
      <a href="ClassEdit.php">
          <button class="EditClass" type="button"> EDIT CLASS </button>
      </a>
    </div>
    <!---This section will handle the Seating Chart, Grade, and Student Buttons--->
    <div class="directory-container">
      <!-- Edit seating chart container to translate button position -->
      <div class="seating-chart-container">
            <a href="seatingChart.php">
                <button class="SeatingChart" type="button">
					        <img src = "images/SeatingChart_Clear.png" class="seating-chart-img" height = "120%" alt = "Seating Chart">
				        </button>
            </a>
        </div>
      <div class="GradeButtonHolder">
         <a href="to grades">
             <button class="Grades" type="button">
               <img src = "images/Grades_Clear.png" class= "grades-img" height = "160%" alt = "Grades">
             </button>
         </a>
      </div>
      <div class="StudentButtonHolder">
            <a href="viewStudent.php">
                <button class="Students" type="button" formaction>
					          <img src = "images/Students_Clear.png" height = "100%" alt = "Students">
				        </button>
            </a>
      </div>
    </div>
</body>

</html>
