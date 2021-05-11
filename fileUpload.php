<?php
session_start();
include "configImport.php";

$uploadFile=$_FILES['uploadFile']['tmp_name'];

require 'PHPExcel/Classes/PHPExcel.php';
require_once 'PHPExcel/Classes/PHPExcel/IOFactory.php';
$currentClass = $_SESSION['current_class'];
$objExcel=PHPExcel_IOFactory::load($uploadFile);
foreach($objExcel->getWorksheetIterator() as $worksheet) {
    $highestrow=$worksheet->getHighestRow();

    for($row=0;$row<=$highestrow;$row++) {
        $firstName=$worksheet->getCellByColumnAndRow(0,$row)->getValue();
        $lastName=$worksheet->getCellByColumnAndRow(1,$row)->getValue();
        $nickname=$worksheet->getCellByColumnAndRow(2,$row)->getValue();
        $birthday=$worksheet->getCellByColumnAndRow(3,$row)->getValue();

        if($firstName!='') {
            $insertqry="INSERT INTO `studentinfo`(`student_first_name`, `student_last_name`, `nickname`, `birthday`, `class_id`) 
            VALUES ('$firstName','$lastName', '$nickname', '$birthday', '$currentClass')";
            $insertres=mysqli_query($con,$insertqry);
        }
    }
}
echo "Names added to the list!";
header("Location: viewStudent.php"); //change 
?>