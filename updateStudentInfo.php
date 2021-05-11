<?php
include "config.php";

$firstName = $_POST["first-name"];
$lastName = $_POST["last-name"];
$nickname = $_POST["nickname"];
$birthday = $_POST["birthday"];
$note = $_POST["student-notes"];
$id = $_POST["id"];

$sql = "UPDATE studentInfo SET student_first_name = '$firstName', student_last_name = '$lastName', nickname = '$nickname',
birthday = '$birthday', notes = '$note' where student_id = $id";
if (mysqli_query($link, $sql)) {
  echo "console.log('student info record updated successfully');";

} else {
  echo "console.log('student info record update not successful');";
}

header("Location: seatingChart.php");

?>
