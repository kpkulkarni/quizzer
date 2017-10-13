<?php
    require_once "includes/header.php";
    
    $user_logged_obj = new User($con, $userLoggedIn);
    $question_obj = new Question($con);

?>
<div class="wrapper">
<div class="row">
    <div class="user_info col-sm-2">
        <?php echo "<h4> ". $user_logged_obj->getFirstAndLastName() ."!</h4>";
                echo "<p>Questions Answered</p><div class='large-badge'>".$user_logged_obj->getAnsweredQuestions()."</div>";
                echo "<p>Correct Answers</p><div class='large-badge'>" . $user_logged_obj->getCorrectAnswers() . "</div>";
                echo "<p>Your Points</p><div class='large-badge'>" . $user_logged_obj->getPoints() . "</div>";
                $preferred_category = $user_logged_obj->getPreferredCategory();

        if (!empty($preferred_category)) {
            echo "<div class='category_info'><h4>Your preferred Categories</h4>";
                 

        ?>
        <ul>
    <?php
    foreach ($preferred_category as $key => $category) {
        echo "<a href = 'index.php?c=" . $category . "'><li>" . $category . "</li></a>" ;
    }
        }
        ?>  
                </ul>
            </div>
    </div>

<div class="question_area col-sm-8">
    

    <?php
    if (isset($_GET['c'])) {
        $category = array();
        array_push($category, strip_tags($_GET['c']));
        echo $question_obj->loadAllQuestions($category);
    } else {
        echo $question_obj->loadAllQuestions($user_logged_obj->getPreferredCategory());
    }
    ?>
</div>
<div class="col-sm-2">
    
</div>

</div>	
</div>
<script>
    function fiftyFifty(questionId){
        var qId = questionId; 
        var xhttp = new XMLHttpRequest(); 
     
        xhttp.onreadystatechange = function() {
                   
            if(this.readyState == 4 && this.status == 200){
                console.log(this.responseText); 
                document.getElementById("optionArea" + qId).innerHTML = this.responseText; 
                
            }
           
        }; 
        xhttp.open("POST", "includes/handlers/fifty_fifty_handler.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("qId=" + qId);

    }; 
</script>
</body>
</html>
