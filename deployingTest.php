<?php
	$connect = mysql_connect("localhost", "root", "") or die("Couldn't connect!");
	mysql_select_db("pharmacy_new") or die("Couldn't find the database!");
	session_start();
	$testID = "";
	$testName = "";
	if(array_key_exists('testList',$_POST) || array_key_exists('testTypeBtn',$_POST)){
		$testID = $_POST['testList'];
		$_SESSION['testList'] = $testID;
	}
	
	$testDetails = mysql_query("select testName from test where testID = '$testID';");
			while($row = mysql_fetch_array($testDetails)){
					$testName = $row['testName'];
			}
?>

<?xml version="1.1" encoding="utf-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
 
<html xmlns="http://www.w3.org/1999/xhtml">
	<head> 
		<link rel="stylesheet" type="text/css" href="mystyle.css"/>
		
		<script type="text/javascript">
			function saveTest(){
				document.myform.action = "summary.php";
				document.myform.method = "POST";
				document.myform.target = "_self";
				document.myform.submit();
			}
		</script>
		
	</head>
	<title>Deploying the Test</title>
	<body>
	<div class = "banner"></div>
		
		<a class = "heading">Deploy Test</a>
		
		<div class = "intro">
		Here you can deploy a test for the students. The page allows you to enter the necessary details <br/>for deploying a test such as
		release date/time, password and time limit depending on the specified test type.
		</div>
		<div><hr size=1 align="left" color="black"></div>
		<form action = "deployingTest.php" method = "POST" name = "myform" target = "_self">
		<table border = "0" width="600" cellpadding = "4"  style="background-color: #EBF0EB;">
		<tr>
		<?php
			//A label for the user to let them know what test they're working on
			echo "<td align = left' colspan = '2'><h3>Test Name:  $testName";
			$testID = $_SESSION['testList'];
			echo "<input type = 'hidden' name = 'testList' value = '$testID'/>";
			echo "<input type = 'hidden' name = 'testName' value = '$testName'/>";
			
		?></td>

		</tr>

	<tr>
	<td>
		<b>Select a Test Type:<b>
		<select name = "testType" onchange = "submitTestType()">
			<option>Select Type</option>
			<option value = "0">Practice Test</option>
			<option value = "1">Assessed Test</option>
		</select>
		<input type = 'submit' name = 'testTypeBtn' value = 'Continue!'/>
		<br/><br/>
		<b>Specify Release Date and Time:</b><br/>
		<b>Date:<b>
		<input type = "text" placeholder = "YYYY-MM-DD" name = "releaseDate"/><br/>
		<b>Time:<b>
		<input type = "text" placeholder="HH:MM:SS"  name = "releaseTime"/><br/>
		
	</td>
	<td><br/><br/>
		<b>Specify Expiry Date and Time:</b><br/>
		<b>Date:<b>
		<input type = "text" placeholder = "YYYY-MM-DD" name = "expiryDate"/><br/>
		<b>Time:<b>
		<input type = "text" placeholder="HH:MM:SS"  name = "expiryTime"/>
	</td>
	</tr>
	
	<tr>
	<td colspan = "2"><br/>
		<b>Test Description:</b><br/>
		<textarea name = "description" rows = '3' cols = '31'></textarea><br/>
		
		
	</td></tr>
</form>
	<?php
		$testType = "";
		if(array_key_exists('testType',$_POST)){
			$testType =  $_POST['testType'];
			
		}
		if($testType == '1'){
			
			echo "
			<tr><td colspan = '2'>
			<b>Assessed test</b> selected. There will be a time limit on the test and students will require
			a password to start this test.<br/>
			</tr></td>
			<tr><td>
			<b>Specify a Time Limit:</b><br/>
			
			<b>Hour(s):</b>";
			// Make the hours
			echo "<select name='hours'>";
			for($i=1;$i<=5;$i++) {
				echo "<option value=\"$i\">$i</option>\n";
			}
			echo "</select>
			<b>Minutes: </b>";
		
			// Make the minutes
			echo '<select name="minutes">';
			for($i=0;$i<=9;$i++) {
				echo "<option value=\"0$i\">0$i</option>\n";
			}
			for($i=10;$i<=59;$i++) {
				echo "<option value=\"$i\">$i</option>\n";
			}
			echo "</select>
			</td>
			<td>
			<b>Password: </b>
			<input type = 'text' name = 'password' size = '15'/>
			</td></tr>
			<tr><td colspan = '2' align = 'center'>
			<br/>
			<input type = 'button' name = 'cancel' value = 'Cancel'/>
			<input type = 'reset' name = 'reset' value = 'Reset'/>
			<input type = 'button' name = 'submitTest' value = 'Submit Test' onclick = 'saveTest()'/>
			<input type = 'hidden' name = 'testTypeHidden' value = '$testType'/>
			</td></tr>
			
			
			";
			
		}
		
		if($testType == '0'){
			
			echo "
			<tr><td colspan = '2'>
			<b>Practice test</b> selected. Students will be allowed multiple attempts without any time limits or password.<br/>
			</td></tr>
			
			<tr><td colspan = '2' align = 'center'>
			<input type = 'button' name = 'cancel' value = 'Cancel'/>
			<input type = 'reset' name = 'reset' value = 'Reset'/>
			<input type = 'button' name = 'submitTest' value = 'Submit Test' onclick = 'saveTest()'/>
			<input type = 'hidden' name = 'testTypeHidden' value = '$testType'/>
			</td></tr>";
			
		}
		
	?>
	
	</table>
	</body>
</html>
