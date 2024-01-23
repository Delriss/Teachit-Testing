<?php

class Answer {
    public $answerID;
    public $questionID;
    public $answerText;
    public $isCorrect;
    //Needs Functionality
}

class Question {
    public $questionID;
    public $testID;
    public $questionText;
    public $correctAnswerID;
    public $answers = array();
    //Needs Functionality
}

class Test {
    public $testID;
    public $questions = array();
    //Needs Functionality
}

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include_once($_SERVER['DOCUMENT_ROOT'].'/php/_connect.php');

$testArray = array();

$sql = "SELECT testID, title FROM tests";
$tests = mysqli_query($db_connect, $sql);

foreach ($tests as $test) {
    $testObject = new test;
    $sql = "SELECT questionID, testID, questionText, correctAnswerID FROM questions WHERE testID = " . $test['testID'];
    $questions = mysqli_query($db_connect, $sql);

    foreach ($questions as $question) {
        $questionObject = new question;
        $sql = "SELECT answerID, questionID, answerText, isCorrect FROM answers WHERE questionID = " . $question['questionID'];
        $answers = mysqli_query($db_connect, $sql);

        foreach ($answers as $answer) {
            $answerObject = new answer;
            $answerObject->answerID = $answer['answerID'];
            $answerObject->questionID = $answer['questionID'];
            $answerObject->answerText = $answer['answerText'];
            $answerObject->isCorrect = $answer['isCorrect'];
            $questionObject->answers[] = $answerObject;
        }
        $testObject->questions[] = $questionObject;
    }
    $testArray[] = $testObject;
}

//for testing
//echo $testArray[0]->questions[0]->answers[2]->answerText;

?>

