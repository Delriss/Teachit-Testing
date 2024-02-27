<?php

//Check if data has been submitted correctly
if(empty($_POST['studentNum']) || 
   empty($_POST['firstName']) || 
   empty($_POST['lastName']) || 
   empty($_POST['email']) || 
   empty($_POST['password']) || 
   empty($_POST['confirmPassword'])) 
{
    die("Please fill out all fields");
}

//Check if passwords match
if($_POST['password'] != $_POST['confirmPassword'])
{
    die("Passwords do not match");
}

//Check if email is valid
if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
{
    die("Invalid email address");
}

//Connect to DB
include_once($_SERVER['DOCUMENT_ROOT'].'/php/_connect.php');

//Retrieve info from POST
$studentNum = $_POST['studentNum'];
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$courseTitle = $_POST['courseTitle'];
$email = $_POST['email'];
$password = $_POST['password'];

//Encrypt password
$password = password_hash($password, PASSWORD_BCRYPT);

//Data Sanitization
$studentNum = mysqli_real_escape_string($db_connect, $studentNum);
$firstName = mysqli_real_escape_string($db_connect, $firstName);
$lastName = mysqli_real_escape_string($db_connect, $lastName);
$courseTitle = mysqli_real_escape_string($db_connect, $courseTitle);
$email = mysqli_real_escape_string($db_connect, $email);
$password = mysqli_real_escape_string($db_connect, $password);

//Check to see if Student ID is already in use
$sql = "SELECT * FROM `users` WHERE `ID` = ?";
$stmt = mysqli_prepare($db_connect, $sql); //Prepare SQL statement
mysqli_stmt_bind_param($stmt, "s", $studentNum); //Bind parameters
mysqli_stmt_execute($stmt); //Execute prepared statement
$result = mysqli_stmt_get_result($stmt); //Get results from prepared statement

if(mysqli_num_rows($result) > 0)
{
    echo("Student ID already in use");
    die();
}

//Check to see if email is already in use
$sql = "SELECT * FROM `users` WHERE `email` = ?";
$stmt = mysqli_prepare($db_connect, $sql); //Prepare SQL statement
mysqli_stmt_bind_param($stmt, "s", $email); //Bind parameters
mysqli_stmt_execute($stmt); //Execute prepared statement
$result = mysqli_stmt_get_result($stmt); //Get results from prepared statement

if(mysqli_num_rows($result) > 0)
{
    echo("Email already in use");
    die();
}

//Create Database User
$accessLevel = "0"; //0 = Student, 1 = Teacher, 2 = Admin
$accountLock = "FALSE"; //FALSE = Account is not locked, TRUE = Account is locked

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
mysqli_stmt_bind_param($stmt, "ssssssis", $studentNum, $firstName, $lastName, $email, $password, $courseTitle, $accessLevel, $accountLock); //Bind parameters

if(mysqli_stmt_execute($stmt)) //Execute prepared statement
{
    echo "Registration successful";
}
else
{
    echo "Registration failed:" . mysqli_error($db_connect);
}



