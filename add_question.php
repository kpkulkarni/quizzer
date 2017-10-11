<?php
	require_once "includes/header.php"; 
	require_once "includes/handlers/add_question_handler.php"; 


	
?>
<div class=" wrapper">

	<div class="question_form">

	<h4 class="orange_heading">Add a new question</h4>
	
<div class="form-group row">
	<form action="add_question.php" method="POST" class="form">
		<select name="category" class="form-control col-sm-12">
	<?php 
		$query = mysqli_query($con, "SELECT * FROM categories"); 
		while($loaded_categories = mysqli_fetch_array($query)){ 
			
		echo "<option value='" . $loaded_categories['category'] ."'>" . $loaded_categories['category'] . "</option>";
	}
	?>
		</select><br><br>

	
	<textarea name="q_body" required="required" placeholder="Enter Main question" class="form-control col-sm-12"></textarea><br><br>
	
	
	<label class="col-form-label col-sm-1">A: </label><input type="text" name="option_a" required="required" placeholder="Enter Option A" class="form-control option col-sm-11"><br>
	
	<label class="col-form-label col-sm-1">B: </label><input type="text" name="option_b" required="required" placeholder="Enter Option B" class="form-control option col-sm-11"><br>
	<label class="col-form-label col-sm-1">C: </label><input type="text" name="option_c" required="required" placeholder="Enter Option C" class="form-control option col-sm-11"><br>
	<label class="col-form-label col-sm-1">D: </label><input type="text" name="option_d" required="required" placeholder="Enter Option D" class="form-control option col-sm-11"><br>
	<br><br>
	<label class="col-form-label col-sm-3">Set Correct Option</label>
	<select name="correct_option" required="required" placeholder="Enter correct option" class="form-control option col-sm-9">
		<option value='A'>Option A</option>
		<option value='B'>Option B</option>
		<option value='C'>Option C</option>
		<option value='D'>Option D</option>
	</select>	
	<br><br>

	

	<input type="submit" name="add_question" value="Add Question" class="form-control btn btn-success col-sm-4 q_submit_button">
</form>
	<a href="index.php"><button class="btn btn-danger col-sm-4 q_submit_button">Cancel</button></a>

	</div>




</div>
</div>