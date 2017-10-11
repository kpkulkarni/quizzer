<?php
	ob_start(); 	//output buffer start. 
	session_start(); 	//session start 
	$con = mysqli_connect("localhost", "root", "", "quizzer"); 

	if(mysqli_connect_errno()){
		echo "Unable to connect" . mysqli_connect_errno(); 
	}

	//Points to add for correct answer ... 
	$points = 10; 

?>