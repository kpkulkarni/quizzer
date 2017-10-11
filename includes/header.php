<?php
	require_once "config/config.php"; 
	require_once "includes/classes/User.php"; 
	require_once "includes/classes/Question.php"; 
	
	if(isset($_SESSION['username'])){
		$userLoggedIn = $_SESSION['username']; 
	}
	else {
		header("Location:register.php");
	}


?>
<!DOCTYPE html>
<html>
<head>
	<title>Welcome to Quizzer</title>
	
	<!-- JAVASCRIPT -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script type="text/javascript" src="assets/js/bootstrap.js"></script>

	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">

</head>
<body>


	<nav class="navbar navbar-fixed-top top-bar">
		<div class="container-fluid">
			<a class="nav navbar-brand brand-white" href="index.php">Quizzer</a>
			<ul class="nav navbar-nav navbar-right">
				<li class="nav-item">
					<a href="category_subscribe.php"  class="nav-link">Subscribed Categories</a>
				</li>
				<li class="nav-item">
					<a href="add_question.php"  class="nav-link">Add Question</a>
				</li>
				<li class="nav-item">
					<a href="logout.php" class="nav-link">Logout</a>
				</li>
			</ul>
		</div>
	</nav>
	 
	
