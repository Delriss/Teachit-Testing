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
    public $relativeTestID;
    public $title;
    public $questions = array();
    //Needs Functionality
}

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include_once($_SERVER['DOCUMENT_ROOT'].'/php/_connect.php');

$testArray = array();

//Get all tests from the database
$sql = "SELECT testID, title FROM tests";
$tests = mysqli_query($db_connect, $sql);

//loop through each test in the database
foreach ($tests as $test) {
    //Create a test object
    $testObject = new test;

    //Define the test object's attributes
    $testObject->testID = $test['testID'];
    $testObject->title = $test['title'];

    //Get the questions belonging to the test
    $sql = "SELECT questionID, testID, questionText, correctAnswerID FROM questions WHERE testID = " . $test['testID'];
    $questions = mysqli_query($db_connect, $sql);

    foreach ($questions as $question) {
        //Create a question object
        $questionObject = new question;

        //Define the question object's attributes
        $questionObject->questionID = $question['questionID'];
        $questionObject->testID = $question['testID'];
        $questionObject->questionText = $question['questionText'];
        $questionObject->correctAnswerID = $question['correctAnswerID'];

        //Get the answers for the question
        $sql = "SELECT answerID, relativeAnswerID, questionID, answerText, isCorrect FROM answers WHERE questionID = " . $question['questionID'];
        $answers = mysqli_query($db_connect, $sql);

        foreach ($answers as $answer) {
            //Create an answer object
            $answerObject = new answer;

            //Define the answer object's attributes
            $answerObject->answerID = $answer['answerID'];
            $answerObject->relativeAnswerID = $answer['relativeAnswerID'];
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

//function for returning a test related to a testID
function getTest($testID){
    global $testArray;
    foreach ($testArray as $test){
        if ($test->testID == $testID){
            return $test;
        }
    }
}

//if ajax request is made to retrieveTests.php with specific testID, return the test object
if (isset($_POST['testID'])){
    echo json_encode(getTest($_POST['testID']));
}

?>

