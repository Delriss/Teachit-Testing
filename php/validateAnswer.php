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

//This code checks the user's answer against the correct answer, if the
//  answer is correct, 30 points are added. If the answer is incorrect,
//  10 points are deducted. The echo assists with the Sweet Alerts.
if ($_POST['userAnswered'] == $_SESSION['correctAnswerID']) {
    $_SESSION['currentScore'] = $_SESSION['currentScore'] + 30;
    $_SESSION['questionsAnswered']++;
    echo "e1";
}
else {
    $_SESSION['currentScore'] = $_SESSION['currentScore'] - 10;
    $_SESSION['questionsAnswered']++;
    echo $_SESSION['correctAnswerText'];
}
?>