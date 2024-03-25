<?php

//If not accessed via POST, refuse access - POST will only be via router/JS
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    //If the request is not a POST request, the user will be redirected to the login page
    header("Location: /");
    die();
}

//DB Connection
include_once($_SERVER['DOCUMENT_ROOT'] . '/php/_connect.php');

//Get User ID
$userID = mysqli_real_escape_string($db_connect, $_POST["UID"]);

//Delete User
$sql = "DELETE FROM users WHERE ID = ?";
$stmt = $db_connect->prepare($sql);
$stmt->bind_param("i", $userID);
$stmt->execute();

if ($stmt->affected_rows === 0) {
    echo "Error: User not deleted";
    exit();
}
else
{
    echo "User deleted";
}
?>