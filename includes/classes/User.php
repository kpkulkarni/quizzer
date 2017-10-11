<?php
class User{

		private $user; 
		private $con; 

	public function __construct($con, $user){
		$this->con = $con; 
		$query = mysqli_query($con, "SELECT * FROM users WHERE username = '$user'"); 
		$this->user = mysqli_fetch_array($query); 
	}

	public function getFirstAndLastName(){
		$username = $this->user['username']; 
		$query = mysqli_query($this->con, "SELECT first_name, last_name FROM users WHERE username = '$username'"); 
		$row = mysqli_fetch_array($query); 
		$name = $row['first_name']. " " . $row['last_name']; 
		return $name; 
	}

	public function getPoints(){
		$username = $this->user['username']; 
		$query = mysqli_query($this->con, "SELECT points FROM users WHERE username = '$username'"); 
		$row = mysqli_fetch_array($query); 
		$points = $row['points']; 
		return $points; 
	}

	public function getUsername(){
		return $this->user['username'];
	}

	public function getPreferredCategory(){
		$username = $this->user['username']; 
		$query = mysqli_query($this->con, "SELECT categories FROM users WHERE username = '$username'"); 
		$row = mysqli_fetch_array($query); 
		$categories = $row['categories'];
		$categories = explode(",", $categories);
		array_shift($categories); 
		if($categories[0] == ""){
			$categories = array();
			return $categories; 
		}
		else {
			return $categories; 
		}
	}

	public function getAnsweredQuestions(){
		$username = $this->user['username']; 
		$query = mysqli_query($this->con, "SELECT answered FROM users WHERE username = '$username'"); 
		$row = mysqli_fetch_array($query); 
		return $row['answered']; 
	}

	public function getCorrectAnswers(){
		$username = $this->user['username']; 
		$query = mysqli_query($this->con, "SELECT correct FROM users WHERE username = '$username'"); 
		$row = mysqli_fetch_array($query); 
		return $row['correct']; 
	}



	public function setPreferredCategory($category_string){
		$username = $this->user['username']; 
		$categories = $category_string; 
		$query = mysqli_query($this->con, "UPDATE users SET categories = '$categories' WHERE username = '$username'"); 
		if($query){
			return true;
		}
		else
			return false; 
	}

	public function updateAnsweredData($correct){
		if($correct == "true"){
			$this->addAnswered(); 
			$this->addPoints(); 
		}
		else {
			$this->addAnswered(); 
		}
	}

	public function addPoints(){
		$username = $this->user['username']; 

		$old_points = $this->getPoints(); 
		$new_points = $old_points + 10; 
		
		$old_corrects = $this->getCorrectAnswers(); 
		$old_corrects++; 
		
		$update_query = mysqli_query($this->con, "UPDATE users SET points = '$new_points' WHERE username = '$username'"); 
		$update_query = mysqli_query($this->con, "UPDATE users SET correct = '$old_corrects' WHERE username= '$username'"); 

	}

	public function addAnswered(){
		$username = $this->user['username']; 
		$old_answered = $this->getAnsweredQuestions(); 
		$old_answered++; 

		$update_answered = mysqli_query($this->con, "UPDATE users SET answered = '$old_answered' WHERE username = '$username'"); 
	}



}


?>