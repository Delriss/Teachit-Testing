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
    $lockStatus = 1; //Lock User
}
else
{
    $lockStatus = 0; //Unlock User
}

//Lock/Unlock User
$sql = "UPDATE users SET accountLock = ? WHERE ID = ?";
$stmt = $db_connect->prepare($sql);
$stmt->bind_param("ii", $lockStatus, $userID);
$stmt->execute();

if ($stmt->affected_rows === 0) {
    echo "Error: User not locked/unlocked";
    exit();
}
else
{
    //Get Lastlogin to see if they have ever logged in
    $sql = "SELECT `lastLogin`, `email` FROM `users` WHERE `ID` = ?";
    $stmt = $db_connect->prepare($sql);
    $stmt->bind_param("i", $userID);
    $stmt->execute();
    $result = $stmt->get_result();
    $result = $result->fetch_assoc();

    if($result["lastLogin"] == NULL && $lockStatus == 0)
    {
        //If the user has never logged in and the account is being unlocked, send an email to the user
        $to = $result["email"];
        $subject = "Account Unlocked";
        $message = "Your account has been unlocked. Please login to your account to continue.";
        $headers = "From: noreply@localhost";
        mail($to, $subject, $message, $headers);
    }

    echo "User lock changed";
}
