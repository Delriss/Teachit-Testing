<?php

//check if there is user session
if (!isset($_SESSION['user'])){
    //if not, return to the login page
    header("Location: /login");
}

class Answer {
    public $answerID;
    public $questionID;
    public $relativeAnswerID;
    public $answerText;
    public $isCorrect;
    //Needs Functionality
}

class Question {
    public $questionID;
    public $relativeQuestionID;
    public $testID;
    public $questionText;
    public $correctAnswerID;
    public $answers = array();
    //Needs Functionality
}

class Test {
    public $testID;
    public $title;
    public $testDesc;
    public $questions = array();
    public $subject;
    public $subjectID;
    public $assignedID;
    public $testDateTime;
    //Needs Functionality
}

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include_once($_SERVER['DOCUMENT_ROOT'].'/php/_connect.php');

$testArray = array();

//Get all tests from the database
$sql = "SELECT `testID`, `title`, `testDesc`, `subject`, `assignedID` , `testDateTime` FROM tests";
$tests = mysqli_query($db_connect, $sql);

//loop through each test in the database
foreach ($tests as $test) {
    $testObject = new test;

    //Define the test object's attributes
    $testObject->testID = $test['testID'];
    $testObject->title = $test['title'];
    $testObject->testDesc = $test['testDesc'];
    $testObject->subjectID = $test['subject'];
    $testObject->assignedID = $test['assignedID'];
    $testObject->testDateTime = $test['testDateTime'];

    //Get the subjects belonging to the test using a stored procedure and clear the stored result so we can execute another query
    $sql = "CALL selectSubjectFromSID(?)";
    $stmt = mysqli_prepare($db_connect, $sql);
    $stmt->bind_param("i", $test['subject']);
    $stmt->execute();
    $result = $stmt->get_result();
    $testObject->subject = mysqli_fetch_assoc($result)['subjectName'];
    $stmt->close();

    //Get the questions belonging to the test using stored procedure. store all rows in $questions. clear the stored result so we can execute another query
    $sql = "CALL selectQuestionsForTest(?)";
    $stmt = mysqli_prepare($db_connect, $sql);
    $stmt->bind_param("i", $test['testID']);
    $stmt->execute();
    $questions = $stmt->get_result();
    $stmt->close();

    foreach ($questions as $question) {
        //Create a question object
        $questionObject = new question;

        //Define the question object's attributes
        $questionObject->questionID = $question['questionID'];
        $questionObject->relativeQuestionID = $question['relativeQuestionID'];
        $questionObject->testID = $question['testID'];
        $questionObject->questionText = $question['questionText'];
        $questionObject->correctAnswerID = $question['correctAnswerID'];

        //Get the answers for the question using a stored procedure and clear the stored result so we can execute another query
        $sql = "CALL selectAnswersForQuestion(?)";
        $stmt = mysqli_prepare($db_connect, $sql);
        $stmt->bind_param("i", $question['questionID']);
        $stmt->execute();
        $answers = $stmt->get_result();
        $stmt->close();

        foreach ($answers as $answer) {
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

?>

