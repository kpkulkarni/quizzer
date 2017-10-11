<?php
	if(isset($_POST['login_button'])){
		//Declare variables to store data. 
		$email = ""; 
		$pass = ""; 

		//Sanitize and store data into variables. 
		$email = strip_tags($_POST['login_email']);
		$email = str_replace(" ", "", $email); 
		if(filter_var($email, FILTER_VALIDATE_EMAIL)){
			$email = filter_var($email, FILTER_VALIDATE_EMAIL); 
		}
		else{
			array_push($error_array, "Incorrect email format"); 
			exit(); 
		}
		//Password sanitize 
		$pass = strip_tags($_POST['login_password']); 
		$pass = md5($pass); 
		//Check for validity. If yes start session. 
		$check_query = mysqli_query($con, "SELECT * FROM users WHERE email = '$email' AND password = '$pass'"); 
		$row = mysqli_num_rows($check_query);
		
		if($row != 0){
			$user_array = mysqli_fetch_array($check_query);
			$username = $user_array['username']; //Getting logged in username username 
			$_SESSION['username'] = $username; //storring logged in username in session
			header("Location:index.php"); 

		}
		else {
			array_push($error_array, "Email or Password is incorrect.");
		}



	}

?>