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

$userAnswered = $_POST['userAnswered'];

if ($userAnswered == $_SESSION['correctAnswer']) {
    $_SESSION['currentScore'] = $_SESSION['currentScore'] + 30;
    echo "Correct, your score is now " . $_SESSION['currentScore'];
}
else {
    echo "Incorrect, your score is still " . $_SESSION['currentScore'];
}
//echo $userAnswered;


?>