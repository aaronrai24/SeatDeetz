<?php

  require_once "config.php";

    $id = $_POST['id'];
    $left = $_POST['left'];
    $top = $_POST['top'];
    echo "console.log('$id $left $top');";
    $sql = "UPDATE seatingChart SET left_position = $left, top_position = $top where student_id = $id";
    if (mysqli_query($link, $sql)) {
      //echo "Record updated successfully";
      echo "console.log('successful');";

    } else {
      echo "console.log('not successful');";
    }
?>
