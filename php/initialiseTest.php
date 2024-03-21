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

//Setting the testID to be used throughout testing.php
$_SESSION["testID"] = $_POST['testID'];
//these variables are being initialised so the program can keep track of the user's progress
$_SESSION['questionsAnswered'] = 0;
$_SESSION['currentScore'] = 0;

?>