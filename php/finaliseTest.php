<?php
//If not accessed via POST, refuse access - POST will only be via router/JS
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
	//If the request is not a POST request, the user will be redirected to the login page
	header("Location: /");
	die();
}

//File Security Check to avoid direct access
if (!isset($_SESSION)) {
    die('<p class="lead">User is not logged in.</p>');
}

include_once($_SERVER['DOCUMENT_ROOT'] . '/php/_connect.php');

$sql = "INSERT INTO `userTests` (`UID`, 
                                `TID`, 
                                `score`, 
                                `timestamp`) 
        VALUES (?, ?, ?, CURRENT_TIMESTAMP);";

$stmt = mysqli_prepare($db_connect, $sql); //preparing the sql statement
mysqli_stmt_bind_param($stmt, "iii", $_SESSION['ID'], $_SESSION['testID'], $_SESSION['currentScore']); //binding parameters
mysqli_stmt_execute($stmt); //Execute prepared statement

echo("data inserted");

unset($_SESSION['testID']);
unset($_SESSION['questionsAnswered']);
unset($_SESSION['totalQuestions']);
unset($_SESSION['currentScore']);
unset($_SESSION['correctAnswerID']);
unset($_SESSION['correctAnswerText']);

echo ("sessions removed");

?>