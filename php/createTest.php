<?php

//If not accessed via POST, refuse access - POST will only be via router/JS
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
	//If the request is not a POST request, the user will be redirected to the login page
	header("Location: /");
	die();
}
//Remove direct access to the file and require login
if ($_SESSION['LoggedIn'] == false) {
    header("Location: /login.php");
    die();
}

//this is going to create a new test in the database. It will use lastInsertID to get the testID of the test that was just created, and create the questions for it.
//it will then use lastInsertID again to get the questionID of the question that was just created, and create the answers for it.

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include_once($_SERVER['DOCUMENT_ROOT'].'/php/_connect.php');

//Get the test title from the form
$testTitle = $_POST['testTitle'];
//Get an array of question texts from the form
$questionTexts = $_POST['questionText'];
//Get an array of arrays of answer texts from the form.
$answerTexts = $_POST['answerText'];
//Get array position of correct answer from the form
$isCorrect = $_POST['correctAnswer'];

//Create the test in the database
$sql = "INSERT INTO tests (title) VALUES ('" . $testTitle . "')";
$result = mysqli_query($db_connect, $sql);

//Get the testID of the test that was just created
$testID = mysqli_insert_id($db_connect);

//Loop through each question text
foreach($questionTexts as $questionText) {
    //Create the question in the database
    $sql = "INSERT INTO questions (testID, questionText) VALUES (" . $testID . ", '" . $questionText . "')";
    $result = mysqli_query($db_connect, $sql);

    //Get the questionID of the question that was just created
    $questionID = mysqli_insert_id($db_connect);

    //Loop through each answer text
    for($i = 0; $i < count($answerTexts); $i++) {
        //Create the answer in the database
        if($i == $isCorrect) {
            $sql = "INSERT INTO answers (questionID, answerText, isCorrect) VALUES (" . $questionID . ", '" . $answerTexts[$i] . "', 1)";
            $result = mysqli_query($db_connect, $sql);

            //modify the question to have the correct answer
            $sql = "UPDATE questions SET correctAnswer = " . $i . " WHERE questionID = " . $questionID;
            $result = mysqli_query($db_connect, $sql);
        } else {
            $sql = "INSERT INTO answers (questionID, answerText, isCorrect) VALUES (" . $questionID . ", '" . $answerTexts[$i] . "', 0)";
            $result = mysqli_query($db_connect, $sql);
        }
    }
}




