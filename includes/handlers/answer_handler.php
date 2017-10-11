<?php
    require "../../config/config.php";
    require_once "../classes/User.php";
    
    
if (isset($_SESSION['username'])) {
    $userLoggedIn = $_SESSION['username'];
} else {
    header("Location:register.php");
}
    

    $user_logged_obj = new User($con, $userLoggedIn);


if (isset($_POST['submit_answer'])) {
    if (!isset($_POST['answer'])) {
        header("Location:../../index.php");
        exit();
    }

    $q_id = $_POST['q_id'];

    $answer_to_check = $_POST['answer'];
        

    $check_query = mysqli_query($con, "SELECT correct FROM questions WHERE id = '$q_id'");
    if (mysqli_num_rows($check_query)) {
        $row = mysqli_fetch_array($check_query);
            
        if ($answer_to_check == $row['correct']) {
            $correct = "true";
            $user_logged_obj->updateAnsweredData($correct);
        } else {
            $correct= "false";
            $user_logged_obj->updateAnsweredData($correct);
        }
    }

    header("Location:../../index.php");
}
