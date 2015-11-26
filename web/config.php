<?php

$conn = mysqli_connect("localhost","phpuser","phpuserpw") 
			or die("cannot connected");

@mysqli_select_db($conn, "diary")
or die("cannot connected to database");
	
?>
