
<script type = "text/javascript">
	function submitTrueFalse(){
		document.action = "test.php"
		document.method = "POST";
		document.target = "_blank";
		document.trueFalse.submit();
	}
	
	function submitMultipleChoice(){
		document.action = "test2.php"
		document.method = "POST";
		document.target = "_blank";
		document.multipleChoice.submit();
	}
</script>

<?php
	$type =  $_POST['questionType'];
	$questionName = $_POST['questionName'];
	echo $type;
	echo $questionName;
	
	if($type == 'trueFalse'){
		include 'test.php';
	}
	elseif($type == 'multipleChoice'){
		include 'test2.php';
	}
	
	
?>