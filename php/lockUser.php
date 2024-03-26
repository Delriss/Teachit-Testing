<?php

//If not accessed via POST, refuse access - POST will only be via router/JS
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    //If the request is not a POST request, the user will be redirected to the login page
    header("Location: /");
    die();
}

//DB Connection
include_once($_SERVER['DOCUMENT_ROOT'] . '/php/_connect.php');

//Get User ID + lock status
$userID = mysqli_real_escape_string($db_connect, $_POST["UID"]);
$lockStatus = mysqli_real_escape_string($db_connect, $_POST["lock"]);

//Change Lock Status
if($lockStatus == 0)
{
    $lockStatus = 1;
}
else
{
    $lockStatus = 0;
}

//Lock/Unlock User
$sql = "CALL editLock(?, ?)";
$stmt = $db_connect->prepare($sql);
$stmt->bind_param("ii", $lockStatus, $userID);
$stmt->execute();

if ($stmt->affected_rows === 0) {
    echo "Error: User not locked/unlocked";
    exit();
}
else
{
    echo "User lock changed";
}
