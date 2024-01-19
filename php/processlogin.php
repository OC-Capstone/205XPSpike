<?php
session_start();
//check for required fields from the form
if ((!filter_input(INPUT_POST, 'email'))
        || (!filter_input(INPUT_POST, 'password'))) {
//if ((!isset($_POST["username"])) || (!isset($_POST["password"]))) {
	header("Location: login.php");
	exit;
}

//connect to server and select database (put in proper info)
$mysqli = mysqli_connect("sql3.freemysqlhosting.net", "sql3678207", "cHzzxTKUGz", "sql3678207");

//create and issue the query
$targetemail = filter_input(INPUT_POST, 'email');
$targetpasswd = filter_input(INPUT_POST, 'password');
$sql = "SELECT email, password FROM auth_users WHERE email = '".$targetemail.
        "' AND password = SHA1('".$targetpasswd."')";

$result = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));

if (mysqli_num_rows($result) == 1) {
	setcookie("auth", session_id(), time()+60*30, "/", "", 0);
	header("Location: index.php"); // Or wherever a successful login should take the user
} else {
	header("Location: login.php");
	exit;
}
?>

