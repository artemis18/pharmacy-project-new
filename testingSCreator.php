
<form action = "testingSCreator.php" method = "POST">
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