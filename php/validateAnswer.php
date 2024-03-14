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

//This code is ran when the question is answered, the questionsAnswered variable is incremented by 1
$_SESSION['questionsAnswered'] = $_SESSION['questionsAnswered'] + 1;

//This code checks the user's answer against the correct answer, if the
//  answer is correct, 30 points are added. If the answer is incorrect,
//  10 points are deducted. The echo assists with the Sweet Alerts.
if ($_POST['userAnswered'] == $_SESSION['correctAnswerID']) {
    //correct
    $_SESSION['currentScore'] = $_SESSION['currentScore'] + 30;

    if ($_SESSION['questionsAnswered'] == $_SESSION['totalQuestions']) {
        //this path is used if the user has answered all questions
        $response = [
            "status" => "e2",
            "points" => $_SESSION['currentScore']
        ];
        echo json_encode($response);

    } else {
        //this path is used to continue the test
        echo json_encode(["status" => "e1"]);
    }
    
}
else {
    //incorrect
    $_SESSION['currentScore'] = $_SESSION['currentScore'] - 10;
    if ($_SESSION['questionsAnswered'] == $_SESSION['totalQuestions']) {
        //this path is used if the user has answered all questions
        $response = [
            "status" => "e3",
            "correctAnswerText" => $_SESSION['correctAnswerText'],
            "points" => $_SESSION['currentScore']
        ];
        echo json_encode($response);

    } else {
        //this path is used to continue the test
        $response = [
            "status" => "e4",
            "correctAnswerText" => $_SESSION['correctAnswerText']
        ];
        echo json_encode($response);
        //echo $_SESSION['correctAnswerText'];
    }
}
?>