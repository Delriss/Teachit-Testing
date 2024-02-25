<?php

// Path: php/deleteQuestion.php
// This will delete a question from the database according to the questionID. It will also delete all answers associated with the question as they have a foreign key constraint.

    //Check if the questionID and testID are set in the POST request
    if(isset($_POST["questionIndex"]) && isset($_POST["testID"]))
    {
        //Include the database connection
        include_once($_SERVER['DOCUMENT_ROOT'].'/php/_connect.php');
        //Escape the questionID and testID
        //subtracting 1 from questionIndex to get the relativeQuestionID
        $relativeQuestionID = (mysqli_real_escape_string($db_connect,$_POST["questionIndex"]) - 1);
        $testID = mysqli_real_escape_string($db_connect,$_POST["testID"]);

        //select the questionID from the database where the testID and relativeQuestionID match
        $sql = "SELECT questionID FROM questions WHERE testID = ? AND relativeQuestionID = ?";
        $stmt = $db_connect->prepare($sql);
        $stmt->bind_param("ii", $testID, $relativeQuestionID);
        $stmt->execute();
        $result = $stmt->get_result();
        $question = mysqli_fetch_assoc($result);

        //delete from db with error handling
        $sql = "DELETE FROM questions WHERE questionID = ?";
        $stmt = $db_connect->prepare($sql);
        $stmt->bind_param("i", $question['questionID']);
        if(!$stmt->execute())
        {
            die("Error: " . $stmt->error);
        }
        else{
            echo ("Question deleted successfully");
        }

        //for each question after this one, decrement the relativeQuestionID by 1
        $sql = "UPDATE questions SET relativeQuestionID = relativeQuestionID - 1 WHERE testID = ? AND relativeQuestionID > ?";
        $stmt = $db_connect->prepare($sql);
        $stmt->bind_param("ii", $testID, $relativeQuestionID);
        if(!$stmt->execute())
        {
            die("Error: " . $stmt->error);
        }

    }
    else
    {
        die("Error: Question ID or Test ID not set");
    }

?>