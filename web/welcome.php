<?php

include_once("header.php");

//including the database connection file
include_once("config.php");


	//fetching data in descending order (lastest entry first)
	$query = "SELECT d.DATE, d.SUBJECT, d.CONTENT, f.FEELTING_TYPE, t.TAG_NAME, d.ATTACHMENT "
			 ."FROM T_DIARY d, T_FEELING f, T_TAG t "
			 ."WHERE d.FEELING = f.FEELING_ID and d.TAG = t.TAG_ID "
			 ."AND USER_NAME = '" .$user ."' ORDER BY DATE DESC";
	
	$result = mysqli_query($conn, $query);
?>

<html> 
<head>	
	<title>My Diary</title>
</head>

<body>
<a href="newEntry.php">Add your today's activity</a><br/><br/>

	<table style="width: 80%;">

	<tr bgcolor='#CCCCCC'>
		<td style="width: 15%;">Date</td>
		<td style="width: 20%;">Subject</td>
		<td style="width: 5%;">Feeling</td>
		<td style="width: 5%;">Tag</td>
		<td style="width: 35%;">Content</td>
		<td style="width: 10%;">Attachment(s)</td>
		<td style="width: 10%;">&nbsp;</td>
	</tr>
	<?php
	
	if (mysqli_num_rows($result) < 1) {
		echo "<tr>";
			echo "<td colspan='7' style='text-align: center;'> No record found. </td>";
		echo "</tr>";
	}
	
	while($res = mysqli_fetch_array($result)) { 		
		echo "<tr>";
			echo "<td>".date_format(new DateTime($res['DATE']), 'd/m/Y H:i:s') ."</td>";
			echo "<td>".$res['SUBJECT']."</td>";
			echo "<td>".$res['FEELTING_TYPE']."</td>";	
			echo "<td>".$res['TAG_NAME']."</td>";
			echo "<td>".$res['CONTENT']."</td>";
			echo "<td>".$res['ATTACHMENT']."</td>";
			echo "<td><a href=\"edit.php?id=$res[DIARY_ID]\">Edit</a> | <a href=\"delete.php?id=$res[DIARY_ID]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";
		echo "</tr>";
	}
	
		mysqli_free_result($result);
		mysqli_close($conn);
	?>
	</table>
</body>
</html>