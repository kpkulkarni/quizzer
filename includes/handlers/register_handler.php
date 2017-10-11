<?php
	
$error_array = array();

if(isset($_POST['register_button'])){
	//Decalre variables to store Data submitted 
		 
		$fname = ""	; 
		$lname = ""	; 
		$em1 = ""; 
		$em2 = "";
		$pass1 = "";
		$pass2 = ""; 

	//Sanitize Data and Store in variables
		//Firstname 
		$fname = strip_tags($_POST['fname']); 
		$fname = str_replace(" ", "", $fname); 
		$fname = ucfirst(strtolower($fname)); 
		//Lastname 
		$lname = strip_tags($_POST['lname']); 
		$lname = str_replace(" ", "", $lname); 
		$lname = ucfirst(strtolower($lname)); 
		//email 1 
		$em1 = strip_tags($_POST['reg_email']); 
		$em1 = str_replace(" ", "", $em1); 
		//email confirm
		$em2 = strip_tags($_POST['reg_email2']);
		$em2 = str_replace(" ", "", $em2); 
		//password 
		$pass1 = strip_tags($_POST['reg_password1']); 
		//password confirm
		$pass2 = strip_tags($_POST['reg_password2']); 

	//Compare confirm Emails and Password and if match enter into database. (Create Account)
		if($em1 == $em2){
			if(filter_var($em1, FILTER_VALIDATE_EMAIL)){

				$em = filter_var($em1, FILTER_VALIDATE_EMAIL); 
				//Check if email already in use. 
				$e_check_query = mysqli_query($con, "SELECT * FROM users WHERE email = '$em'");
				$row = mysqli_num_rows($e_check_query); 
				if($row != 0){
					array_push($error_array, "This email is already in use"); 	//fire error when email is already in database. 
				}

			}
			else {
				array_push($error_array, "Incorrect email format.");
			}

		}
		else {
			array_push($error_array, "Emails don't match"); 
		}

		if(strlen($fname) > 25 || strlen($fname) < 2){
			array_push($error_array, "Your first name must be between 2 and 25 characters"); 
		}

		if(strlen($lname) > 25 || strlen($lname) < 2){
			array_push($error_array, "Your last name must be between 2 and 25 characters");
		}

		//Password match and length check. 
		if($pass1 != $pass2){
			array_push($error_array, "Passwords don't match."); 
		}

	//Else Display error  


		//If no error enter data into database.
		if(empty($error_array)){
			$pass1 = md5($pass1);	//Encrypt password
			$username = strtolower($fname . "_" . $lname); 	//Create unique username.
			$check_username_query = mysqli_query($con, "SELECT username FROM users WHERE username = '$username'"); 

			$i= 0; //Counter for username check.
			while(mysqli_num_rows($check_username_query) != 0){
				$i++; //increament i by 1 
				$username = $username . "_" . $i;
				$check_username_query = mysqli_query($con, "SELECT username FROM users WHERE username = '$username'"); 
			}

			//Enter data into databse query

			$query = mysqli_query($con, "INSERT INTO users VALUES(NULL, '$fname', '$lname', '$username', '$em', '$pass1', 0, 0, 0, ',')"); 

			
				array_push($error_array, "You are all set! Please login now."); 
			

		}

	}
?>