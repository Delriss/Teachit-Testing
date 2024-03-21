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
    empty($_POST['firstName']) ||
    empty($_POST['lastName']) ||
    empty($_POST['email']) ||
    empty($_POST['password']) ||
    empty($_POST['confirmPassword'])
) {
    die("Please fill out all fields");
}

//Check if passwords match
if ($_POST['password'] != $_POST['confirmPassword']) {
    die("Passwords do not match");
}

//Check if email is valid
if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    die("Invalid email address");
}

//Connect to DB
include_once($_SERVER['DOCUMENT_ROOT'] . '/php/_connect.php');

//Retrieve info from POST
$studentNum = $_POST['studentNum'];
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$courseTitle = $_POST['courseTitle'];
$email = $_POST['email'];
$password = $_POST['password'];
$accountLock = $_POST['accountLock'];

//
//Data Validation START
//Check if student number is a number
if (!is_numeric($studentNum)) {
    die("Student number must be numerical characters only.");
}
//Check if password is at least 8 characters long and contains at least one number and one special character
if (!preg_match('/^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{8,}$/', $password)) {
    die("Password must be at least 8 characters long and contain at least one number and one special character.");
}
//Check if email is valid
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Invalid email address");
}
//Data Validation END
//

//Encrypt password
$password = password_hash($password, PASSWORD_BCRYPT);

//Data Sanitization
$studentNum = mysqli_real_escape_string($db_connect, $studentNum);
$firstName = mysqli_real_escape_string($db_connect, $firstName);
$lastName = mysqli_real_escape_string($db_connect, $lastName);
$courseTitle = mysqli_real_escape_string($db_connect, $courseTitle);
$email = mysqli_real_escape_string($db_connect, $email);
$password = mysqli_real_escape_string($db_connect, $password);
$accountLock = mysqli_real_escape_string($db_connect, $accountLock);

//Check to see if Student ID is already in use
$sql = "SELECT * FROM `users` WHERE `ID` = ?";
$stmt = mysqli_prepare($db_connect, $sql); //Prepare SQL statement
mysqli_stmt_bind_param($stmt, "s", $studentNum); //Bind parameters
mysqli_stmt_execute($stmt); //Execute prepared statement
$result = mysqli_stmt_get_result($stmt); //Get results from prepared statement

if (mysqli_num_rows($result) > 0) {
    die("Student ID already in use");
}

//Check to see if email is already in use
$sql = "SELECT * FROM `users` WHERE `email` = ?";
$stmt = mysqli_prepare($db_connect, $sql); //Prepare SQL statement
mysqli_stmt_bind_param($stmt, "s", $email); //Bind parameters
mysqli_stmt_execute($stmt); //Execute prepared statement
$result = mysqli_stmt_get_result($stmt); //Get results from prepared statement

if (mysqli_num_rows($result) > 0) {
    die("Email already in use");
}

//Create Database User
$accessLevel = "0"; //0 = Student, 1 = Teacher, 2 = Admin

if ($accountLock == "on") { //FALSE = Account is not locked, TRUE = Account is locked
    $accountLock = "1";
} else {
    $accountLock = "0";
}

$sql = "INSERT INTO `users` (`ID`, 
                           `firstName`, 
                           `lastName`, 
                           `email`, 
                           `password`,
                           `courseTitle`,
                           `accessLevel`,
                           `accountLock`,
                           `TIMESTAMP`)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, CURRENT_TIMESTAMP);";

$stmt = mysqli_prepare($db_connect, $sql); //Prepare SQL statement
mysqli_stmt_bind_param($stmt, "ssssssii", $studentNum, $firstName, $lastName, $email, $password, $courseTitle, $accessLevel, $accountLock); //Bind parameters

if (mysqli_stmt_execute($stmt)) //Execute prepared statement
{
    echo "Registration successful";
} else {
    echo "Registration failed:" . mysqli_error($db_connect);
}

