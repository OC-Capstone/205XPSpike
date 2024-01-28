<?php
session_start();
//check for required fields from the form
if ((!filter_input(INPUT_POST, 'email'))
        || (!filter_input(INPUT_POST, 'password'))) {
//if ((!isset($_POST["username"])) || (!isset($_POST["password"]))) {
	header("Location: login.html");
	exit;
}

//connect to server and select database (put in proper info)
$mysqli = mysqli_connect("sql3.freemysqlhosting.net", "sql3678207", "cHzzxTKUGz", "sql3678207");

//create and issue the query
$targetemail = filter_input(INPUT_POST, 'email');
$targetpasswd = filter_input(INPUT_POST, 'password');
$sql = "SELECT email, password FROM users WHERE email = '".$targetemail.
        "' AND password = SHA1('".$targetpasswd."')";

$result = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));

//verify user credentials test case
if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);

	if ($hashed_password_entered === $row['password']) { //this is just getting and comparing the hashed password in the db w one entered by a user to see if they match.
        // if the password is correct then set session variable and redirect
        $_SESSION['email'] = $row['email'];
        setcookie("auth", session_id(), time()+60*30, "/", "", 0);
        header("Location: index.html");
        exit;
    } else {
        
        header("Location: login.html?error=invalid_credentials");
        exit;
    }
}


if (mysqli_num_rows($result) == 1) {
	setcookie("auth", session_id(), time()+60*30, "/", "", 0);
	header("Location: index.html"); // Or wherever a successful login should take the user
} else {
	header("Location: login.html");
	exit;
}

?>

