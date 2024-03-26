<?php

//If not accessed via POST, refuse access - POST will only be via router/JS
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    //If the request is not a POST request, the user will be redirected to the login page
    header("Location: /");
    die();
}

//Connect to DB
include_once($_SERVER['DOCUMENT_ROOT'] . '/php/_connect.php');

//Retrieve info from POST
$studentNum = $_POST['UID'];

//Get the student's data
$sql = "CALL selectUserFromID(?)";
$stmt = mysqli_stmt_init($db_connect);
mysqli_stmt_prepare($stmt, $sql);
mysqli_stmt_bind_param($stmt, "s", $studentNum);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

//Output the student's data
echo json_encode(mysqli_fetch_assoc($result));

