<!DOCTYPE html>
<?php
	require_once "config/config.php"; 
	require_once "includes/handlers/register_handler.php";
	require_once "includes/handlers/login_handler.php"; 



?>
<html>
<head>
	<title></title>
	<!-- JAVASCRIPT -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script type="text/javascript" src="assets/js/bootstrap.js"></script>

	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/register.css">
</head>
<body>
	<div class="center">
	<form action="register.php" method="POST">
		<h3>Don't have account? Sign Up</h3>
		<input type="text" name="fname" placeholder="First Name" required="required"><br><br>
		<?php if(in_array("Your first name must be between 2 and 25 characters", $error_array)){
			echo "<p>Your first name must be between 2 and 25 characters</p>"; 
		} ?>
		<input type="text" name="lname" placeholder="Last Name" required="required"><br><br>
		<?php if(in_array("Your last name must be between 2 and 25 characters", $error_array)){
			echo "<p>Your last name must be between 2 and 25 characters</p>"; 
		} ?>

		<input type="email" name="reg_email" placeholder="Enter your email id" required="required"><br><br>
		<input type="email" name="reg_email2" placeholder="Confirm email id" required="required"><br><br>
		<?php if(in_array("Emails don't match", $error_array)){
				echo "<p>Emails don't match</p>"; 
			}
			if(in_array("This email is already in use", $error_array)){
				echo "<p>This email is already in use</p>";
			}
			if(in_array("Incorrect email format.", $error_array)){
				echo "<p>Incorrect email format.</p>";
			}
		 ?>

		<input type="password" name="reg_password1" placeholder="Password" required="required"><br><br>
		<input type="password" name="reg_password2" placeholder="Confirm password" required="required"><br><br><br>
		<?php if(in_array("Passwords don't match.", $error_array)){
			echo "<p>Passwords don't match.</p>"; 
		} ?>

		<input type="submit" name="register_button" value="Sign Up" class="btn btn-success">
		<?php if(in_array("You are all set! Please login now.", $error_array)){
			echo "<p>You are all set! Please login now.</p>"; 
		} ?>

	</form>

	<form action="register.php" method="POST">
		<h3>Already have accoun? Login!</h3>
		<input type="email" name="login_email" placeholder="Enter your email id" required="required"><br><br>
		<input type="password" name="login_password" placeholder="Password" required="required"><br><br>
		<input type="submit" name="login_button" value="Log In" class="btn btn-success">

	</form>
	</div>

</body>
</html>