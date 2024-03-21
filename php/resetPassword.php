<?php

//If not accessed via POST, refuse access - POST will only be via router/JS
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    //If the request is not a POST request, the user will be redirected to the login page
    header("Location: /");
    die();
}

//Check if data has been submitted correctly
if (
    empty($_POST['studentNum']) ||
    empty($_POST['password']) ||
    empty($_POST['confirmPassword'])
)
{
    die("Please fill out all fields");
}

//Check if passwords match
if ($_POST['password'] != $_POST['confirmPassword']) {
    die("Passwords do not match");
}

//Retrieve info from POST
$studentNum = $_POST['studentNum'];
$password = $_POST['password'];

//Check if password is at least 8 characters long and contains at least one number and one special character
if (!preg_match('/^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{8,}$/', $password)) {
    die("Password must be at least 8 characters long and contain at least one number and one special character.");
}

//Connect to DB
include_once($_SERVER['DOCUMENT_ROOT'] . '/php/_connect.php');

//Encrypt password
$password = password_hash($password, PASSWORD_BCRYPT);

//Edit Database User
$sql = "UPDATE users SET password = ? WHERE ID = ?";
$stmt = $db_connect->prepare($sql);
$stmt->bind_param("ss", $password, $studentNum);

//Return Status
if ($stmt->execute()) {
    echo "Password reset successfully";
} else {
    echo "Error: " . $sql . "<br>" . $db_connect->error;
}