<?php
session_start();

//check for required fields from the form
if ((!filter_input(INPUT_POST, 'Meal_name'))
        || (!filter_input(INPUT_POST, 'Calorie_count'))
            || (!filter_input(INPUT_POST, 'Protien_count'))
                || (!filter_input(INPUT_POST, 'Carb_count'))
                    || (!filter_input(INPUT_POST, 'Fats_count'))) {

//this is slightly redundant but the regular expression pattern set in each html file overwrites the ability for a user to bypass the conditions. 
	header("Location: nutrition_input.html"); 
	exit;
}else{
    header("Location: nutrition_input.html");
        exit;
}

$breakfast_completed = true;

// If breakfast task is completed, set a flag to show the checkmark
if ($breakfast_completed) {
    // Set a session variable to indicate breakfast completion
    session_start();
    $_SESSION['breakfast_completed'] = true;
}

// Redirect back to the form page
header("Location: nutrition_input.html");
exit();

?>