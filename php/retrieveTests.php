<?php

// //File Security Check to avoid direct access
// if (!isset($_SESSION)) {
//     header("Location: /login");
//     die('<p class="lead">User is not logged in.</p>');
// }

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
    public $title;
    public $questions = array();
    public $testDesc;
    public $subject;
    //Needs Functionality
}

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include_once($_SERVER['DOCUMENT_ROOT'].'/php/_connect.php');

$testArray = array();

//Get all tests from the database
$sql = "SELECT `testID`, `title`, `testDesc`, `subject` FROM tests";
$tests = mysqli_query($db_connect, $sql);

//loop through each test in the database
foreach ($tests as $test) {
    $testObject = new test;

    //Define the test object's attributes
    $testObject->testID = $test['testID'];
    $testObject->title = $test['title'];
    $testObject->testDesc = $test['testDesc'];
    $testObject->subject = $test['subject'];

    //Get the subjects belonging to the test
    $sql = "SELECT `subjectName` FROM `subjects` WHERE `SID` = ?";
    $stmt = mysqli_prepare($db_connect, $sql);
    mysqli_stmt_bind_param($stmt, "i", $test['subject']);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $testObject->subject = mysqli_fetch_assoc($result)['subjectName'];

    //Get the questions belonging to the test
    $sql = "SELECT questionID, testID, questionText, correctAnswerID FROM questions WHERE testID = " . $test['testID'];
    $questions = mysqli_query($db_connect, $sql);

    foreach ($questions as $question) {
        $questionObject = new question;

        //Define the question object's attributes
        $questionObject->questionID = $question['questionID'];
        $questionObject->testID = $question['testID'];
        $questionObject->questionText = $question['questionText'];
        $questionObject->correctAnswerID = $question['correctAnswerID'];

        //Get the answers for the question
        $sql = "SELECT answerID, questionID, answerText, isCorrect FROM answers WHERE questionID = " . $question['questionID'];
        $answers = mysqli_query($db_connect, $sql);

        foreach ($answers as $answer) {
            $answerObject = new answer;
            
            //(FIX) needs relative answer id in context of the range of answers for the questions, etc 1-4. This needs to be done in the database as well

            //Define the answer object's attributes
            $answerObject->answerID = $answer['answerID'];
            $answerObject->questionID = $answer['questionID'];
            $answerObject->answerText = $answer['answerText'];
            $answerObject->isCorrect = $answer['isCorrect'];
            
            //Add the answer object to the question object's array of answers
            $questionObject->answers[] = $answerObject;
        }
        //Add the question object to the test object's array of questions
        $testObject->questions[] = $questionObject;
    }
    //Add the test object to the array of tests
    $testArray[] = $testObject;
}

//for testing
//echo $testArray[0]->questions[0]->answers[2]->answerText;

?>

