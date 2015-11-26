<?php

include_once("header.php");

//including the database connection file
include_once("config.php");


//fetching data in descending order (lastest entry first)
$result = mysqli_query($conn, "SELECT * FROM T_DIARY WHERE USER_NAME = '" .$user ."' ORDER BY DATE DESC");

?>

<html> 
<head>	
	<title>My Diary</title>
</head>

<body>
<a href="newEntry.php">Add your today's activity</a><br/><br/>

	<table style="width: 80%;">

	<tr bgcolor='#CCCCCC'>
		<td style="width: 10%;">Date</td>
		<td style="width: 20%;">Subject</td>
		<td style="width: 5%;">Feeling</td>
		<td style="width: 5%;">Tag</td>
		<td style="width: 40%;">Content</td>
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
			echo "<td>".$res['DATE']."</td>";
			echo "<td>".$res['SUBJECT']."</td>";
			echo "<td>".$res['FEELING']."</td>";	
			echo "<td>".$res['TAG']."</td>";
			echo "<td>".$res['CONTENT']."</td>";
			echo "<td>".$res['ATTACHMENT_ID']."</td>";
			echo "<td><a href=\"edit.php?id=$res[id]\">Edit</a> | <a href=\"delete.php?id=$res[id]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";
		echo "</tr>";
	}
	
		mysqli_free_result($result);
		mysqli_close($conn);
	?>
	</table>
</body>
</html>