<?php
	$server = "";
	$user_name = "root";
	$pass = "";
	$db = "cse";

	$connection = mysqli_connect("localhost",$user_name,$pass,$db) or die("Can not connect to database.");
 	$connection -> set_charset("utf8");

  // if($connection){
	// 	echo "string";
	// }
?>
