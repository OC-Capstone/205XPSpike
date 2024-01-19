<?php
session_start();

$mysqli = mysqli_connect("sql3.freemysqlhosting.net", "sql3678207", "cHzzxTKUGz", "sql3678207");

$fname = ucfirst(strtolower(filter_input(INPUT_POST, 'first_name')));
$lname = ucfirst(strtolower(filter_input(INPUT_POST, 'last_name')));
$email = filter_input(INPUT_POST, 'email');
$password = filter_input(INPUT_POST, 'password');

$check_duplicate_query = "SELECT COUNT(*) AS count FROM users WHERE email = '$email'";
$result = mysqli_query($mysqli, $check_duplicate_query) or die(mysqli_error($mysqli));
$row = mysqli_fetch_assoc($result);

if ($row['count'] > 0) {
    $_SESSION['error_message'] = "Email address is already associated with an account.";
    header("Location: createaccount.php");
    exit;
}

$sql = "INSERT INTO users (firstName, lastName, email, password) 
        VALUES ('$fname', '$lname', '$email', SHA1('$password'))";

$result = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));

if ($result) {
    $_SESSION['account_created_message'] = "Account created successfully. You can now log in.";
    header("Location: login.php");
    exit;
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($mysqli);
    header("Location: register.php");
    exit;
}
?>