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

//$_SESSION['testID'] exists
$_SESSION['questionsAnswered'] = 0;
$_SESSION['currentScore'] = 0;
$_SESSION['correctAnswer'] = 999;
$subject = "blank";
$option1 = "blank";
$option2 = "blank";
$option3 = "blank";
$option4 = "blank";

foreach ($testArray as $test) {
    if ($test->testID == $_SESSION["testID"]) {
        $questionCount = count($test->questions);
        $questionText = $test->questions[$_SESSION['questionsAnswered']]->questionText;
        $subject = $test->subject;
        $_SESSION['correctAnswer'] = $test->questions[$_SESSION['questionsAnswered']]->correctAnswerID;
        $option1 = $test->questions[$_SESSION['questionsAnswered']]->answers[0]->answerText;
        $option2 = $test->questions[$_SESSION['questionsAnswered']]->answers[1]->answerText;
        $option3 = $test->questions[$_SESSION['questionsAnswered']]->answers[2]->answerText;
        $option4 = $test->questions[$_SESSION['questionsAnswered']]->answers[3]->answerText;
    }
    
    //temporary code to assist with the hierarchy of the test object, will be removed once the hierarchy is finalised
    // foreach ($test->questions as $question) {
    //     //echo $question->relativeQuestionID;
    //     foreach ($question->answers as $answer) {
    //         //echo $answer->relativeAnswerID;
    //     }
    // }
};

echo ('<div class="testingQuestion" id="question-text">
            <h5>Question: ' . ($_SESSION['questionsAnswered'] + 1) . ' of ' . $questionCount . ' | Subject: ' . $subject . '</h5>
            <hr>
            <h3>' . $questionText . '</h3>
        </div>
        <hr>
        <div id="testingOption1">
            <p class="testingOption">Option 1:</p>
            <button type="submit" class="btn btn-dark rounded-pill" id="option1" data-id=0>' . $option1 . '</button>
            <hr>
        </div>
        <div id="testingOption2">
            <p class="testingOption">Option 2:</p>
            <button type="submit" class="btn btn-dark rounded-pill" id="option2" data-id=1>' . $option2 . '</button>
            <hr>
        </div>
        <div id="testingOption3">
            <p class="testingOption">Option 3:</p>
            <button type="submit" class="btn btn-dark rounded-pill" id="option3" data-id=2>' . $option3 . '</button>
            <hr>
        </div>
        <div id="testingOption4">
            <p class="testingOption">Option 4:</p>
            <button type="submit" class="btn btn-dark rounded-pill" id="option4" data-id=3>' . $option4 . '</button>
            <hr>
        </div>
        <p>Click on a button to submit your answer.</p>
    </div>
    ');
?>