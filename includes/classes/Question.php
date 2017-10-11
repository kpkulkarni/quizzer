<?php
class Question{
		private $con; 
		private $user_logged_obj; 

	public function __construct($con){
		$this->con = $con; 
		$this->user_logged_obj = new User($this->con, $userLoggedIn); 
	}

	public function loadAllQuestions($category = array()){
			$result = ""; 

		if(!empty($category)){
			
			$where_query = "";
		

			foreach ($category as $category) {
					
				$where_query .= "category = '$category' OR ";
				
			}

			$where_query = rtrim($where_query, " OR ");
			

			$query = mysqli_query($this->con, "SELECT * FROM questions WHERE $where_query ORDER BY id DESC"); 
		}
		else {
			$query= mysqli_query($this->con, "SELECT * FROM questions ORDER BY id DESC"); 
		}

		if(mysqli_num_rows($query) !== 0){ 
			while($row = mysqli_fetch_array($query)){

				$options_array = explode(",", $row['options']); 
								
				$result .= "<div class='well'><p>Category is <a href='index.php?c=" . $row['category'] . "'>" . 
							$row['category']. "</a></p>" . 
							"<h3>" . $row['q_body'] . "</h3>" . 
							"<form action='includes/handlers/answer_handler.php' method='POST'>" .
							"<div id='optionArea". $row['id'] ."'>".
							"<input type='radio' name='answer' value='A'> " . $options_array[0] .  "<br>" .
							"<input type='radio' name='answer' value='B'> " . $options_array[1] .	"<br>" .
							"<input type='radio' name='answer' value='C'> " . $options_array[2] .	"<br>" .
							"<input type='radio' name='answer' value='D'> " . $options_array[3] .	"<br></div>" .
							"<input type='hidden' name = 'q_id' value='" .$row['id'] . "'>" . 
							"<input type='submit' name='submit_answer' value='Lock Answer' class='lock_answer_btn'>" .
							"</form>".	
							"<button id='question" . $row['id'] . "' onclick = fiftyFifty(" . $row['id'] .  ")>50 - 50 </button>  <br>" .
														
							"<p>Added By " . $row['added_by'] . "</p> </div>" ; 
			}
		}
		else {
			$result .= "There are no questions to load."; 
		}
		return $result; 
	}
}
	
	
?>