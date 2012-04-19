<?php
	$connect = mysql_connect("localhost", "root", "") or die("Couldn't connect!");
	mysql_select_db("pharmacy_new") or die("Couldn't find the database!");
	session_start();
	$scenarioID = "";
	if(array_key_exists('testScenarios',$_POST) || array_key_exists('edit',$_POST)){
		$scenarioID = $_POST['testScenarios'];
		$_SESSION['testScenarios'] = $scenarioID;
	}
	
	$scenarioName = "";
	$description = "";
	$questions = "";
	$scenarioDetails = mysql_query("select * from scenario where ScenarioID = '$scenarioID';");
			while($row = mysql_fetch_array($scenarioDetails)){
					$scenarioName = $row['scenarioName'];
					$description = $row['description'];
			}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?xml version="1.0" encoding="UTF-8"?>
<html xmlns="http://www.w3.org/1999/xhtml">
	<style>
	#container{
	width:760px;
	}
	#prescriptionForm{
	position:relative;
	float:left;
	
	width:350px;
	height:350px;
	margin:5px;
	}
	#patientForm{
	position:relative;
	float:right;
	
	width:350px;
	padding:15px;
	margin:5px;

	}
	#addQuestionForm{
	position: relative;
	float:bottom;
	float:center;
	
	width:750px;
	overflow:auto;
	}
	#scenarioname{
	
	
	margin:5px;
	}
	#Qformdiv{
	position: relative;
	
	width: 715px;
	padding:15px;
	margin-top:5px;
	}
	#questionForm{
	position:relative;
	width: 750px;
	overflow: auto;
	margin:5px;
	}
	</style>
	<link rel="stylesheet" type="text/css" href="mystyle.css"/>
	<head>
		
		<title> Scenario Creator</title>	
		<script type="text/javascript" language="javascript">  
			function saveQuestion($Qtype ,$Qtext ){
				    {//ajax
						var xmlhttp;
			
						if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
						  xmlhttp=new XMLHttpRequest();
						}
						else {// code for IE6, IE5
						  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
						}
						
						xmlhttp.onreadystatechange=function(){
						  if (xmlhttp.readyState==4 && xmlhttp.status==200) {
							// action on completion of processing
						  }
						}
						queryString = "?QText = " + $Qtext + "&QType = " + qType;
						xmlhttp.open("GET", "saveQuestion.php" + queryString, true);
						xmlhttp.send(null);
					}
					
			}
			
			function editQuestion(Qtext, Qtype, myform){
				
				switch(Qtype){
				case "Multiple_choice" : openMultiChoiceEditor(myform); 
				break;
				case "True_False" : openTrueFalseEditor(myform); 
				break;
				default: alert("error");
				}
			}
			
			function openMultiChoiceEditor(myform){
				
				document.myform.action ="test.php";
				document.myform.method ="POST";
				document.myform.target ="_blank";
				document.myform.submit();
			}
			
			function openTrueFalseEditor(myform){
				document.myform.action ="test2.php";
				document.myform.method ="POST";
				document.myform.target ="_blank";
				document.myform.submit();
			}
			
			function createform(i){
				var selection = document.getElementById("questionType");
				var selectionText = selection[selection.selectedIndex].text;
				var myform = "myform"+i;
				$form = '<form name = "';
				$form += myform;
				$form += '"> ';
				$form += '<label>Question text: <input type = "text" name = "qText"></label>';
				$form += '<label>questionType: <input type = "text" name = "qType" disabled = "true"'; 
				$form += 'value ="';
				$form += selectionText;
				$form += '"';
				$form += '/></label>';
				$form += '<input type = "button" value = "save" onclick = "saveQuestion(qType.value,qText.value,myform)"/>';
				$form += '<input type = "button" value = "edit" onclick = "editQuestion(qText.value,qType.value,myform)"/>';
				$form += '</form>';
			
				return $form;
			}
			
			function questionCreate(numQuestions){  
				var i = 1;
				for(i = 0; i<numQuestions; i++){
					var createQform = document.createElement("div");
					createQform.id = "Qformdiv";
					createQform.innerHTML = createform(i); 
					document.getElementById("questionForm").appendChild(createQform);
				}
			}
			
			function save()
			{
				  document.forms["addQuestion"].submit();
			}
		</script>		
	</head>
	
	<body>	
	<div class = "banner"></div>

		<a class = "heading">Scenario Creator</a>
		<div class = "intro" >
		Here you can create a new scenario by adding a prescription form, writing up a description and <br/>
		adding/creating questions.
		</div>
		<hr size=1 align="left" color="black">
		
		<div id="container" >
		
		
		
		<div id = "scenarioname" style="background-color: #EBF0EB">
		<?php echo "<h3 style='background-color: #EBF0EB' >You are currently working on '$scenarioName'</h3>";?>
			<form action = "scenarioCreator.php" method = "POST">
				<b>Scenario Name:<b> 
				<?php echo "<input type = 'text' name='scenarioName' value = '$scenarioName'/>"; ?>
				<b>Select a Prescription Form: </b>
				<select><option>Select</option>
				</select>
				<br/>
				<b>Description:</b> <br/>
				<?php echo "<textArea name = 'prescriptions' cols = '30' rows = '5' > $description</textarea>" ?></label>
				 <input type = "submit" value = "Save" name = "saveScenario" />

			</form>
		</div>
		 <div id= "prescriptionForm" style="background-color: #EBF0EB">
			<p><b>Prescription Form Preview</b></p>
		 </div>
		 
		 <div id = "patientForm" style="background-color: #EBF0EB">
			<p><b>Patient Details</b></p>
			 <form>
			 <label> <b>Name:</b> <input type = "text" size="46px" name="name"/> </label><br/>
			 <label> <b>Age: </b><input type = "text" size ="48px"name="age"/> </label><br/>
			 <label> <b>Address: </b><input type = "text" size = "43px" name="address"/> </label> <br/>
			 <label> <b>Additional Details:</b> <br/><textarea 
			 rows="10" cols = "40" name = "additional"> </textarea> </label>
			 </form>
		</div>
		 <div id = "questionForm" style="background-color: #EBF0EB">
		 <!-- something to display question form(s)-->
		 <!-- end questions forms-->
		 </div>
		 <div id= "addQuestionForm" style="background-color: #EBF0EB">
		 
<form action = "ScenarioCreator.php" method = "POST">
<b>Number of Questions:</b><select name = 'numOptions'>
	<?php
		for($i=1;$i<=10;$i++) {
			echo "<option value=\"$i\">$i</option>\n";
		}
	?>
		</select>
			 
		
	<input type = "submit" name = "submit" value = "Add Questions"/>
</form>

<?php

			$numOptions = "";
			$questionType = "";
			if(array_key_exists('submit',$_POST)){
				$numOptions = $_POST['numOptions'];
				
				echo "<input type = 'hidden' value = '$numOptions' name = 'numOptions'/>";
			}

				for($i=1;$i<=$numOptions;$i++) {
					echo '<form name = "myform" action = "handler.php" method = "POST" target = "_blank">';
					$question = 'QuestionText'.$i;
					echo $question;
					echo "<input type = 'text' name = '$question'/>";
					$label = 'Question Type'.$i;
					echo $label;
					echo "
					<select name = 'questionType'>
					 <option value = 'multipleChoice'> Multiple_choice</option>
					 <option value = 'trueFalse'> True_False</option>
					 </select>";
					 if(array_key_exists('edit',$_POST)){
						$questionType = $_POST['questionType'];
					}
					 echo "
					 <input type = 'hidden' value = '$question' name = 'questionName'/>
				
					<input type = 'submit' name = 'edit' value = 'Edit'/>
					";
					echo '<br/></form>';

				}
			?>
		 </div>
	 </div>
	
	</body>
</html>
 <?php
 
		if(array_key_exists('saveScenario',$_POST) || array_key_exists('edit',$_POST)){
			//Receiving the user input
			$newScenarioName = $_POST['scenarioName'];
			$newDescription = $_POST['prescriptions'];
			//Call the function to save the test
			echo $newScenarioName;
			echo $newDescription;
			//saveTest($newName, $newDescription);
			//Refresh the page
			//die ('<META HTTP-EQUIV="Refresh" CONTENT="0;URL=scenarioCreator.php">');
		}

	?>

