<?php
	$db_user = "root";
	$db="groupe88";
	$db_pass = "";
	$con=mysqli_connect("localhost:3306",$db_user,$db_pass,$db);
	if (mysqli_connect_errno()){
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
?>