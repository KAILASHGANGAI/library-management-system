<?php
$host = "localhost";
$user = "root";
$password ="";
$database = "lms";
$connect = mysqli_connect($host,$user,$password,$database);
if ($connect) {
	//echo "connection successfully";
}else{
	echo "not connected database";
}
?>