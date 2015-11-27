<?php

include_once("header.php");

//including the database connection file
include_once("config.php");

//if(isset($_POST['Submit'])) {	
	$date = $_POST['date'];
	$subject = $_POST['subject'];
	$content = $_POST['content'];
	
	$feeling = $_POST['feeling'];
	$tag = $_POST['tag'];
	//$attachment = $_POST['attachment'];
		
	// checking empty fields
	if(empty($date) || empty($subject) || empty($content)) {
				
		if(empty($date)) {
			echo "<font color='red'>Date field is empty.</font><br/>";
		}
		
		if(empty($subject)) {
			echo "<font color='red'>Subject field is empty.</font><br/>";
		}
		
		if(empty($content)) {
			echo "<font color='red'>Content field is empty.</font><br/>";
		}
		
		//link to the previous page
		echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
	} else { 
		// if all the fields are filled (not empty) 

		//insert data to database	
		$result = mysqli_query($conn, "INSERT INTO T_DIARY(USER_NAME, DATE, SUBJECT, CONTENT, FEELING, TAG) " 
									."VALUES('$user','$date','$subject', '$content', '$feeling', '$tag')");
		
		if(! $result ) {
			die('Could not enter data: ' . mysql_error());
		}
		
		//display success message
		echo "<font color='green'>Data added successfully.";
		echo "<br/><a href='welcome.php'>View Result</a>";
		
		// header( "Location: welcome.php" );
	}
//}
	if($conn) {
		mysqli_close($conn);
	}
?>
