<?php

include "configImport.php";
error_reporting(0);

   $id = $_GET['rn'];
   $sql = "DELETE FROM studentinfo WHERE student_id = '$id'";

   $data = mysqli_query($con, $sql);
   if($data) {
      header("Location: viewStudent.php");
   }
   else {
      echo "Error deleting student";
   }
?>