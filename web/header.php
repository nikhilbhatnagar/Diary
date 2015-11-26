<?php

// Start the session
session_start();

$user = $_SESSION["user"];
$usrRole = $_SESSION["role"];

if(empty($user) || empty($usrRole)) {
	header( "Location: login.html" );
}

if($usrRole == 'ADMIN') {
	echo "Welcome Admin " .htmlentities($user);
	echo "&nbsp;&nbsp;&nbsp;<a href='logout.php'>Logout</a> <br/><br/>";
} else {
	echo "Welcome " .htmlentities($user);
	echo "&nbsp;&nbsp;&nbsp;<a href='logout.php'>Logout</a> <br/><br/>";
}

?>