<?php
	$connect = mysql_connect("localhost", "root", "") or die("Couldn't connect!");
	mysql_select_db("pharmacy_new") or die("Couldn't find the database!");
	session_start();
	
	$testID = $_POST['testList'];
	echo "TestId: ".$testID;
	echo "<br/>";
	
	$testName =  $_POST['testName'];
	echo "Test Name: ".$testName;
	echo "<br/>";
	
	$description = $_POST['description'];
	echo "Description: ".$description;
	echo "<br/>";
	
	date_default_timezone_set('Europe/London');
	$date = date('yy-m-d h:i:s ', time());
	echo "Time Stamp: ".$date;
	echo "<br/>";
	
	$releaseDate = $_POST['releaseDate'];
	$releaseTime = $_POST['releaseTime'];
	$release = $releaseDate." ".$releaseTime;
	echo "Release DateTime: ".$release;
	echo "<br/>";
	
	$expiryDate = $_POST['expiryDate'];
	$expiryTime = $_POST['expiryTime'];
	$expiry = $expiryDate." ".$expiryTime;
	echo "Expiry DateTime: ". $expiry;
	echo "<br/>";
	
	$testTypeID = $_POST['testTypeHidden'];
	$timeLimit = "";
	$password = "";
	if($testTypeID == '1'){
		$hours = $_POST['hours'];;
		$minutes = $_POST['minutes'];
		$timeLimit = $hours.":".$minutes.":00";
		echo "Time Limit: ".$timeLimit; 
		echo "<br/>";
		
		$password = $_POST['password'];
		echo "Password: ".$password;
		echo "<br/>";
	}
	
	echo "TestType ID: ".$testTypeID;
	
	$query = mysql_query("update test set description = '$description', 
	releaseTime = '$release', expiryTime = '$expiry', time_limit = '$timeLimit', password = '$password',
	testTypeID = '$testTypeID' where testID = '$testID';");
	
	if($query){
		echo "The test data has been set!";
	}
	{
	}
?>