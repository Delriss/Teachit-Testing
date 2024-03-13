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
include_once($_SERVER['DOCUMENT_ROOT'] . '/php/retrieveTests.php');

$questionsAnswered = 0;

foreach ($testArray as $test) {
    if ($test->testID == $_SESSION["testID"]) {
        $questionCount = count($test->questions);
        $questionText = $test->questions[$questionsAnswered]->questionText;
    }


    // foreach ($test->questions as $question) {
    //     //echo $question->relativeQuestionID;
    //     foreach ($question->answers as $answer) {
    //         //echo $answer->relativeAnswerID;
    //     }
    // }
};

//echo $questionCount;
echo $questionText;

?>