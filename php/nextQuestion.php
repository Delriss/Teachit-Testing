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

foreach ($testArray as $test) {
    if ($test->testID == $_SESSION["testID"]) {
        $_SESSION['totalQuestions'] = count($test->questions);
        $subject = $test->subject;
        $questionText = $test->questions[$_SESSION['questionsAnswered']]->questionText;

        //This is for use with answer validation
        $_SESSION['correctAnswerID'] = $test->questions[$_SESSION['questionsAnswered']]->correctAnswerID;

        $option1 = $test->questions[$_SESSION['questionsAnswered']]->answers[0]->answerText;
        $option2 = $test->questions[$_SESSION['questionsAnswered']]->answers[1]->answerText;
        $option3 = $test->questions[$_SESSION['questionsAnswered']]->answers[2]->answerText;
        $option4 = $test->questions[$_SESSION['questionsAnswered']]->answers[3]->answerText;

        switch ($_SESSION['correctAnswerID']) {
            case 0:
                $_SESSION['correctAnswerText'] = $option1;
                break;
            case 1:
                $_SESSION['correctAnswerText'] = $option2;
                break;
            case 2:
                $_SESSION['correctAnswerText'] = $option3;
                break;
            case 3:
                $_SESSION['correctAnswerText'] = $option4;
                break;
        }
    }
};

echo ('<div class="testingQuestion" id="question-text">
            <h5>Question: ' . ($_SESSION['questionsAnswered'] + 1) . ' of ' . $_SESSION['totalQuestions'] . ' | Subject: ' . $subject . '</h5>
            <hr>
            <h3>' . $questionText . '</h3>
        </div>
        <hr>
        <div id="testingOption1">
            <p class="testingOption">Option 1:</p>
            <button type="submit" class="btn btn-dark rounded-pill" id="option" data-id=0>' . $option1 . '</button>
            <hr>
        </div>
        <div id="testingOption2">
            <p class="testingOption">Option 2:</p>
            <button type="submit" class="btn btn-dark rounded-pill" id="option" data-id=1>' . $option2 . '</button>
            <hr>
        </div>
        <div id="testingOption3">
            <p class="testingOption">Option 3:</p>
            <button type="submit" class="btn btn-dark rounded-pill" id="option" data-id=2>' . $option3 . '</button>
            <hr>
        </div>
        <div id="testingOption4">
            <p class="testingOption">Option 4:</p>
            <button type="submit" class="btn btn-dark rounded-pill" id="option" data-id=3>' . $option4 . '</button>
            <hr>
        </div>
        <p>Click on a button to submit your answer.</p>
    </div>
    ');


?>