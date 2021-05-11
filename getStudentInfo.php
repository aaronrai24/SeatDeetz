<?php
error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE);
require_once "config.php";
session_start();

  //echo $_POST['student_id_form'];
  //Get student id to use in query
  $id = $_POST['student_id_form'];

  if($id) {

    $sql = "SELECT *
            FROM studentInfo
            WHERE student_id = $id";
    $result = mysqli_query($link, $sql) or die("Bad Query: $sql");
    $row = mysqli_fetch_assoc($result);
    //echo "after query";
    //echo var_dump($row);

    $fname_form = $row['student_first_name'];
    $lname_form = $row['student_last_name'];
    $nickname_form = $row['nickname'];
    $birthday_form = $row['birthday'];
    $notes_form = $row['notes'];

    //Insert data from query into array to be sent to client
    $response_array['fname_form'] = $fname_form;
    $response_array['lname_form'] = $lname_form;
    $response_array['nickname_form'] = $nickname_form;
    $response_array['birthday_form'] = $birthday_form;
    $response_array['notes_form'] = $notes_form;
    echo json_encode($response_array);
  }


?>
