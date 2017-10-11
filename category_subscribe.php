
<div class="wrapper">
	<?php
	require "includes/header.php"; 
	$logged_user_obj = new User($con, $userLoggedIn); 

	if(isset($_POST['subscribe'])){
		$sub_category_array = $_POST['select_category']; 
		$category_string = ""; 
		foreach ($sub_category_array as $value) {
			$category_string .= "," . $value; 
		}
		if($logged_user_obj->setPreferredCategory($category_string)){
			echo "Categories Saved."; 
		}
		else {
			echo "error saving categories."; 
		}
	}
	if(isset($_POST['cancel'])){
		header("Location: index.php"); 
	}

	$old_categories = $logged_user_obj->getPreferredCategory(); 
?>
<div class="wrapper">
	<div class="edit_category">
	<form action = "category_subscribe.php" method="POST">
		<?php $categories_query = mysqli_query($con, "SELECT * FROM categories"); 
		while ($row = mysqli_fetch_array($categories_query)) {

			
			echo "<input type='checkbox' name='select_category[]' value='". $row['category'] ."'";  
				if(in_array($row['category'], $old_categories)) 
				echo "checked='checked'"; 
				echo ">" . $row['category'] . "<br>";
			
			}	
		?>
		<input type="submit" name="subscribe" value="Save">
		<input type="submit" name="cancel" value="Cancel">
		

	</form>
	</div>
</div>

</div>
