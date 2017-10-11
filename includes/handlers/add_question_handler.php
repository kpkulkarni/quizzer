<?php

if(isset($_POST['add_question'])){
		$question = ""; 	//Question body
		$option_a = ""; 
		$option_b = "";
		$option_c = ""; 
		$option_d = "";
		$userLoggedIn = $_SESSION['username'];

		$error_array = array(); 

		$question = strip_tags($_POST['q_body']); 
		

		$option_a = strip_tags($_POST['option_a']);
		$option_b = strip_tags($_POST['option_b']);
		$option_c = strip_tags($_POST['option_c']);
		$option_d = strip_tags($_POST['option_d']);

		$correct_option = strip_tags($_POST['correct_option']); 
		$category = strip_tags($_POST['category']); 
		//Check if question is empty 
		if(strlen($question) < 10 ){
			array_push($error_array, "Question must contain at least 10 characters"); 
		}
		else if ($question == ""){
			array_push($error_array, "Question can not be blank");	
		}
		//Check option should not contain comma and can not be empty 

		if(strpos($option_a, ",") || strpos($option_b, ",") || strpos($option_c, ",") || strpos($option_d, ",")){
			array_push($error_array, "Options can not have a comma");
		}
		else if ($option_a == "" || $option_b == "" || $option_c == "" || $option_d == "" ){
			array_push($error_array, "Options can not be blank"); 
		}

		//Check if correct option does not have more than 1 character
		if(strlen($correct_option) > 1){
			array_push($error_array, "Correct option can be only 1 character"); 
		}

		//check if category has at least 4 characters. 
		if(strlen($category) < 4){
			array_push($error_array, "Category must have at least 4 characters"); 
		}
 	
		//If error_array is empty then enter data into database.
		if(empty($error_array)) {

			$options = $option_a . "," . $option_b . "," . $option_c . "," .  $option_d; 
			//Database entering query 
			$query = mysqli_query($con, "INSERT INTO questions VALUES(NULL, '$question', '$options', '$correct_option', '$category', '$userLoggedIn')");
			array_push($error_array, "Question added!") ; 
			
		}

		//display errors if error_array is not empty
		else {
			foreach ($error_array as $error) {
				echo $error;
			}
		}

	}
?>