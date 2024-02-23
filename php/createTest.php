<?php

//this is going to create a new test in the database. It will use lastInsertID to get the testID of the test that was just created, and create the questions for it.
//it will then use lastInsertID again to get the questionID of the question that was just created, and create the answers for it.

//FIX needs to validate that the user is a lecturer or admin when the user roles are implemented
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include_once($_SERVER['DOCUMENT_ROOT'].'/php/_connect.php');

//validate post data
if(!isset($_POST['testTitle']) || !isset($_POST['testDescription']) || !isset($_POST['testSubject']) || !isset($_POST['questions'])){
    echo "Test Creation Failed: Missing Data";
    exit();
}

//Get the test title from the form
$testTitle = $_POST['testTitle'];
//Get the test description from the form
$testDescription = $_POST['testDescription'];
//Get the subject from the form
$subject = $_POST['testSubject'];
//this array contains questions, an array of their answers, and an array of the correct answers.
$question = $_POST['questions'];

$sql = "INSERT INTO `tests` (`title`, 
                           `testDesc`, 
                           `subject`)
        VALUES (?, ?, ?);";

$stmt = mysqli_prepare($db_connect, $sql); //Prepare SQL statement
mysqli_stmt_bind_param($stmt, "ssi", $testTitle, $testDescription, $subject); //Bind parameters

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

        echo $q['answers'][$i];
        echo $q['correctAnswer'];
        echo $i;

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









