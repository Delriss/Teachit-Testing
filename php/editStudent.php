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
    empty($_POST['email'])
) {
    die("Please fill out all fields");
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
$accountLock = $_POST['accountLock'] ?? "off";

//
//Data Validation START
//Check if student number is a number
if (!is_numeric($studentNum)) {
    die("Student number must be numerical characters only.");
}
//Check if email is valid
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Invalid email address");
}
//Data Validation END
//

//Data Sanitization
$studentNum = mysqli_real_escape_string($db_connect, $studentNum);
$firstName = mysqli_real_escape_string($db_connect, $firstName);
$lastName = mysqli_real_escape_string($db_connect, $lastName);
$courseTitle = mysqli_real_escape_string($db_connect, $courseTitle);
$email = mysqli_real_escape_string($db_connect, $email);
$accountLock = mysqli_real_escape_string($db_connect, $accountLock);

//Edit Database User
$accessLevel = "0"; //0 = Student, 1 = Teacher, 2 = Admin

if ($accountLock == "on") { //FALSE = Account is not locked, TRUE = Account is locked
    $accountLock = "1";
} else {
    $accountLock = "0";
}

$sql = "CALL editUser(?, ?, ?, ?, ?, ?)";
$stmt = mysqli_prepare($db_connect, $sql); //Prepare SQL statement
mysqli_stmt_bind_param($stmt, "sssssi", $studentNum, $firstName, $lastName, $email, $courseTitle, $accountLock); //Bind parameters

if (mysqli_stmt_execute($stmt)) //Execute prepared statement
{
    echo "Update successful";
} else {
    echo "Update failed:" . mysqli_error($db_connect);
}