<?php
class Question{
		private $con; 
		private $user_logged_obj; 

	public function __construct($con){
		$this->con = $con; 
		// $this->user_logged_obj = new User($this->con, $userLoggedIn); 
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

	public function fifty_fifty($qId){
		//I have extensively used php array functions in this method... study 
		$result = ""; 
		$skip = ""; 
		$option_names = array("A", "B", "C", "D"); 

		$query = mysqli_query($this->con, "SELECT options FROM questions WHERE id='$qId'"); 
		$row = mysqli_fetch_array($query); 
		$options_array = explode(",", $row['options']); 
		
		$correct_ans_query = mysqli_query($this->con, "SELECT correct FROM questions WHERE id='$qId'");
		$row = mysqli_fetch_array($correct_ans_query); 
		$correct_ans = $row['correct']; 
		 
		$option_answer_array = array_combine($option_names, $options_array); 

		$correct_array = array($correct_ans => $option_answer_array[$correct_ans]); 
		unset($option_answer_array[$correct_ans]); 
		
		$one = array_rand($option_answer_array); 
		
		$correct_array[$one] = $option_answer_array[$one]; 
		ksort($correct_array); 

		foreach($correct_array as $key=>$value){
			$result .= "<input type='radio' name='answer' value='". $key . "'> " . $value .  "<br>"; 
		}
		
		return $result;



	}

	public function fifty_fifty_compact($qId){
		//Declare empty result string
		$result = ""; 
		//Query dtabase for selecting options and correct option in a single query
		$query = mysqli_query($this->con, "SELECT options, correct FROM questions WHERE id = '$qId'"); 
		$row = mysqli_fetch_array($query);  //fetching results as an array
		//exploading options string into an array and combining that array with option names to get option ans combination
			
		$option_ans_array = array_combine(array("A", "B", "C", "D"), explode(",", $row['options'])); 
				
		//While loop for deleting random two incorrect options from option_ans array
		$i = 0; 
		while($i < 2){
			$random = array_rand($option_ans_array); 
			if($random != $row['correct']){
				unset($option_ans_array[$random]); 
				$i++; 
			}
		}
		//sorting the final array to randomize correct option
		ksort($option_ans_array);
		
		//Foreach loop to add form input elements to result string. 	
		foreach($option_ans_array as $key=>$value){
			$result .= "<input type='radio' name='answer' value='". $key . "'> " . $value .  "<br>";
		}
		//Return result string. 
		return $result;
	}

	
}
	
	
?>