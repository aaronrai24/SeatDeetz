<?php
//Change Database(erptest)
$con=mysqli_connect('localhost', 'root','', 'classes');

if(mysqli_connect_errno()) {
    echo 'Failed to connect to database'.mysqli_connect_error();
}
?>