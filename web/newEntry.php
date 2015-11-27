<?php
	include_once("header.php");
?>

<html>
<head>
	<title>Add new diary entry</title>
	<link rel="stylesheet" type="text/css" href="css/diary.css">
	
	<script type="text/javascript" src="scripts/jquery.js"></script>
	<script type="text/javascript">
		var isValid = 0;
	
		$(document).ready(function() {
			getDropDownValues();

			$('#addRecord').on('click', function() {
				if($('#date').val().length == 0) {
					addError(true, $('#date'));
				} else {
					addError(false, $('#date'));
					isValid++;
				}

				if($('#subject').val().length == 0) {
					addError(true, $('#subject'));
				} else {
					addError(false, $('#subject'));
					isValid++;
				}

				if($('#content').val().length == 0) {
					addError(true, $('#content'));
				} else {
					addError(false, $('#content'));
					isValid++;
				}

				if(isValid == 3) {
					document.forms[0].submit();
				}
			});
		});

		function getDropDownValues() {
			var $newDiv = $('<div />');
			$.ajax({
				  url: 'getDropDownValues.php',
				  type: 'GET',
				  success: function(data) {
					$newDiv.html(data);
					
					if($(data).find('FEELINGS').attr('count') != '0') {
						$('#feelingTD').html('<select name="feeling"><option>&nbsp;</option>' +$newDiv.find('FEELINGS').html() +'</select>');
					}

					if($(data).find('TAGS').attr('count') != '0') {
						$('#tagTD').html('<select name="tag"><option>&nbsp;</option>' +$newDiv.find('TAGS').html() +'</select>');
					}
				  },
				  error: function(e) {
					//called when there is an error
					//console.log(e.message);
					alert('Error : '+e.message);
				  }
				});
		}

		function addError(isErr, $this) {
			if(isErr) {
				$this.removeClass('flatText');
				$this.addClass('txtError');
			} else {
				$this.removeClass('txtError');
				$this.addClass('flatText');
			}
		}
	</script>
</head>

<body>
	<a href="welcome.php">Home</a>
	<br/><br/>

	<form action="add.php" method="post" name="form1">
		<table style="width: 50%;">
			<tr> 
				<td>Date</td>
				<td><input type="datetime-local" name="date" id="date" class="flatText" /></td>
			</tr>
			<tr> 
				<td>Subject</td>
				<td><input type="text" name="subject" id="subject" size="41" class="flatText" /></td>
			</tr>
			<tr> 
				<td>Feeling</td>
				<td id="feelingTD"></td>
			</tr>
			<tr> 
				<td>Tag</td>
				<td id="tagTD"></td>
			</tr>
			<tr> 
				<td>Content</td>
				<td><textarea rows="4" cols="40" name="content" id="content" class="flatText" ></textarea></td>
			</tr>
			<tr> 
				<td>Attachments</td>
				<td id="attachmentTD"><input type="file" name="attachment"></input></td>
			</tr>
			<tr> 
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<tr> 
				<td>&nbsp;</td>
				<td><input type="button" name="Submit" value="Add" id="addRecord"></td>
			</tr>
		</table>
	</form>
</body>
</html>

