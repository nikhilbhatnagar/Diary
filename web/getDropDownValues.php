<?php

	//including the database connection file
	include_once("config.php");
	
	$returnResult;
	$result = mysqli_query($conn, "SELECT * FROM T_FEELING");
	if (!$result) {
		die('Invalid query: ' . mysql_error());
	}
	
	if (mysqli_num_rows($result) < 1) {
		$returnResult = "<FEELINGS count='0'></FEELINGS>";
	} else {
		$returnResult = "<FEELINGS count='" .mysqli_num_rows($result) ."'>";
		while($res = mysqli_fetch_array($result)) {
			$returnResult .="<option value='" .$res['FEELING_ID'] ."'>" .$res['FEELTING_TYPE'] ." </option>";
		}
		$returnResult .="</FEELINGS>";
	}
	
	$result1 = mysqli_query($conn, "SELECT * FROM T_TAG");
	if (!$result1) {
		die('Invalid query: ' . mysql_error());
	}
	
	if (mysqli_num_rows($result1) < 1) {
		$returnResult .="<TAGS count='0'></TAGS>";
	} else {
		$returnResult .="<TAGS count='" .mysqli_num_rows($result1) ."'>";
		while($res = mysqli_fetch_array($result1)) {
			$returnResult .="<option value='" .$res['TAG_ID'] ."'>" .$res['TAG_NAME'] ." </option>";
		}
		$returnResult .="</TAGS>";
	}
	
	mysqli_free_result($result);
	mysqli_free_result($result1);
	mysqli_close($conn);
	
	echo $returnResult;
?>