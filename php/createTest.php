<?php

//this is going to create a new test in the database. It will use lastInsertID to get the testID of the test that was just created, and create the questions for it.
//it will then use lastInsertID again to get the questionID of the question that was just created, and create the answers for it.

//FIX needs to validate that the user is a lecturer or admin when the user roles are implemented
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include_once($_SERVER['DOCUMENT_ROOT'].'/php/_connect.php');

//check if all required data has been POSTed
if(!isset($_POST['testTitle']) || !isset($_POST['testDescription']) || !isset($_POST['testSubject']) || !isset($_POST['questions'])){
    echo "Test Creation Failed: Missing Data";
    exit();
}

//is auth equal to 0? this means it is a "user" level account and their tests need to be assigned to a userID
if($_SESSION["auth"] == 0){
    //if the userID is not set, we don't need to set the userID in the database
    if(!isset($_SESSION["ID"])){
        echo "Test Creation Failed: Missing Data";
        exit();
    }
    else{
        $userID = $_SESSION["ID"];
    
    }
}
else{
    $userID = null;
}

//Get the test title from the form
$testTitle = mysqli_real_escape_string($db_connect, $_POST['testTitle']);
//Get the test description from the form
$testDescription = mysqli_real_escape_string($db_connect, $_POST['testDescription']);
//Get the subject from the form
$subject = $_POST['testSubject'];
//get the date/time of the test from the form
$dateTime = mysqli_real_escape_string($db_connect, $_POST['testDateTime']);
if ($dateTime == "") {
    $dateTime = null;
}
//this array contains questions, an array of their answers, and an array of the correct answers.
$question = $_POST['questions'];

//VALIDATION
//validate all variables against the database constraints
if(empty($testTitle) || empty($testDescription) || empty($subject)){
    echo "Test Creation Failed: Missing Data";
    exit();
}

//validate testSubject can be cast to an integer
if(!is_numeric($subject)){
    echo "Test Creation Failed: Invalid Data";
    exit();
}
else{
    $subject = (int)$subject;
}

//check each variable's length against the database constraints
if(strlen($testTitle) > 50 || strlen($testDescription) > 255){
    echo "Test Creation Failed: Data too long";
    exit();
}

//for each question in the array, check the question text and the answers against the database constraints
foreach($question as $q){
    if(sizeof($q['answers']) !=4){
        echo "Test Creation Failed: not using 4 questions";
        exit();
    }
    if(strlen($q['questionText']) > 255){
        echo "Test Creation Failed: Data too long";
        exit();
    }
    foreach($q['answers'] as $a){
        if(strlen($a) > 1000){
            echo "Test Creation Failed: Data too long";
            exit();
        }
    }
}

//if userID is set, we need to insert the test into the database with the userID
if($userID != null){
    $sql = "INSERT INTO `tests` (`title`, 
                        `testDesc`, 
                        `subject`,
                        `assignedID`,
                        `testDateTime`)
    VALUES (?, ?, ?, ?, ?);";

    $stmt = mysqli_prepare($db_connect, $sql); //Prepare SQL statement
    mysqli_stmt_bind_param($stmt, "ssiis", $testTitle, $testDescription, $subject, $userID, $dateTime); //Bind parameters
}
else{
    $sql = "INSERT INTO `tests` (`title`, 
                           `testDesc`, 
                           `subject`,
                           `testDateTime`)
        VALUES (?, ?, ?, ?);";

    $stmt = mysqli_prepare($db_connect, $sql); //Prepare SQL statement
    mysqli_stmt_bind_param($stmt, "ssis", $testTitle, $testDescription, $subject, $dateTime); //Bind parameters 
}

if(!mysqli_stmt_execute($stmt)) //Execute prepared statement
{
    echo "Test Creation Failed:" . mysqli_error($db_connect);
}

//Get the testID of the test that was just created
$testID = mysqli_insert_id($db_connect);

//loop through each question in the array allowing us to treat each one as a separate question
foreach($question as $q){
    //keep track of the question number based on the index of the array
    $questionNumber = array_search($q, $question);

    //Create the question in the database using a prepared statement, inserting the relativeQuestionID, the testID, the questionText
    $sql = "INSERT INTO `questions` (`relativeQuestionID`, 
                           `testID`, 
                           `questionText`)
        VALUES (?, ?, ?);";

    $stmt = mysqli_prepare($db_connect, $sql); //Prepare SQL statement
    mysqli_stmt_bind_param($stmt, "iis", $questionNumber, $testID, $q['questionText']); //Bind parameters

    if(!mysqli_stmt_execute($stmt)) //Execute prepared statement
    {
        echo "Test Creation Failed:" . mysqli_error($db_connect);
    }

    //Get the questionID of the question that was just created
    $questionID = mysqli_insert_id($db_connect);

    //for size of the answers array, create the answers in the database using a prepared statement, inserting the relativeAnswerID, the questionID, the answerText
    for($i = 0; $i < sizeof($q['answers']); $i++){

        //if the answer is correct, set the isCorrect value to 1, else set it to 0
        if($i == $q['correctAnswer']){
            $correct = 1;
        } else {
            $correct = 0;
        }

        //Create the question in the database using a prepared statement, inserting the relativeQuestionID, the testID, the questionText
        $sql = "INSERT INTO `answers` (`relativeAnswerID`, 
                            `questionID`, 
                            `answerText`,
                            `isCorrect`)
            VALUES (?, ?, ?, ?);";

        $stmt = mysqli_prepare($db_connect, $sql); //Prepare SQL statement
        mysqli_stmt_bind_param($stmt, "iisi", $i, $questionID, $q['answers'][$i] ,$correct); //Bind parameters

        if(!mysqli_stmt_execute($stmt)) //Execute prepared statement
        {
            echo "Test Creation Failed:" . mysqli_error($db_connect);
        }

        //if the answer is correct, update the correctAnswerID in the questions table to the answerID of the correct answer
        if($correct == 1){
            $sql = "UPDATE `questions` 
                    SET `correctAnswerID` = ?
                    WHERE `questionID` = ?;";

            $stmt = mysqli_prepare($db_connect, $sql); //Prepare SQL statement
            mysqli_stmt_bind_param($stmt, "ii", $i, $questionID); //Bind parameters

            if(!mysqli_stmt_execute($stmt)) //Execute prepared statement
            {
                echo "Test Creation Failed:" . mysqli_error($db_connect);
            }
        }
    }  
}
?>









