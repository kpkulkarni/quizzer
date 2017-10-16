<?php
    include("../../config/config.php"); 
    include("../classes/Question.php"); 
    include("../classes/User.php"); 
  

    if(isset($_SESSION['username'])){
        $userLoggedIn = $_SESSION['username']; 
	}
	else {
		header("Location:register.php");
	}


    if(isset($_POST['qId'])){
        $qId = $_POST['qId']; 
        $question_obj = new Question($con); 
        echo $question_obj->fifty_fifty_compact($qId); 

    }

?>