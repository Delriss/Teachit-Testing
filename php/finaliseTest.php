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

//this file is uploading data to the database so it needs to connect to the _connect file
include_once($_SERVER['DOCUMENT_ROOT'] . '/php/_connect.php');

//stored procedure to check if the test has been completed before
$stmt = $db_connect->prepare("CALL checkPreviousTests(?, ?)");
$stmt->bind_param('ii', $_SESSION['ID'], $_SESSION['testID']);
$stmt->execute();
$run = $stmt->get_result();
$stmt->close();

$count = mysqli_num_rows($run);

if ($count === 0) { //if the test has not been completed before
	
	//stored procedure to insert the test results into the database
	$stmt = $db_connect->prepare("CALL finaliseTest(?, ?, ?, ?)");
	$stmt->bind_param('iiii', $_SESSION['ID'], $_SESSION['testID'], $_SESSION['currentScore'], $_SESSION['subjectID']);
	$stmt->execute();
	$stmt->close();

	echo("data inserted"); //this is for testing purposes. This will not be visible unless there is an issue

} else if ($count === 1) { //if the test has been completed before

	//stored procedure to update the test results in the database if the test has previously been completed
	$stmt = $db_connect->prepare("CALL updateTestScore(?, ?, ?)");
	$stmt->bind_param('iii', $_SESSION['ID'], $_SESSION['testID'], $_SESSION['currentScore']);
	$stmt->execute();
	$stmt->close();

	echo("data updated"); //this is for testing purposes. This will not be visible unless there is an issue

} else {
	echo("error");
}

//clearing the session variables which were used so the next test will be unaffected and to reduce the amount stored in $_SESSION
unset($_SESSION['testID']);
unset($_SESSION['questionsAnswered']);
unset($_SESSION['totalQuestions']);
unset($_SESSION['currentScore']);
unset($_SESSION['correctAnswerID']);
unset($_SESSION['correctAnswerText']);
unset($_SESSION['subjectID']);

echo ("sessions removed"); //this is for testing purposes. This will not be visible unless there is an issue

?>