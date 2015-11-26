<?php

$user = $_POST["user"];
$pass = $_POST["password"];

//including the database connection file
include_once("config.php");

if(empty($user) || empty($pass)) {

	if(empty($user)) {
		echo "<font color='red'>User field is empty.</font><br/>";
	}

	if(empty($pass)) {
		echo "<font color='red'>Password field is empty.</font><br/>";
	}

	//link to the previous page
	echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
} else {
	$q = "SELECT ROLE_NAME FROM T_DIARY_USERS WHERE USER_NAME='" .$user ."' and USER_PASSWORD='" .$pass ."'";
	$result = mysqli_query($conn, $q);
	if (mysqli_num_rows($result) < 1) {
		exit("<br/>Incorrect user name / password. <br/><a href='javascript:self.history.back();'>Go Back</a>");
	} else {
		$row = mysqli_fetch_row($result);
		$usrRole = $row[0];
		
		// Start the session
		session_start();
		
		$_SESSION["user"] = $user;
		$_SESSION["role"] = $usrRole;
		
		header( "Location: welcome.php" );
	}
	mysqli_free_result($result);	
}
mysqli_close($conn);
?>