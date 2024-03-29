<?php

//check if there is user session
if (!isset($_SESSION['user'])){
    //if not, return to the login page
    header("Location: /login");
}

include_once($_SERVER['DOCUMENT_ROOT'].'/php/retrieveTests.php');

//Function to display the tests in the database as cards{
    foreach ($testArray as $test){

        //CHANGE REQUEST:
        //if the test has a date and time that is in the future, we need to disable the test and mark it as upcoming
        //if the test has a date and time that is in the past, we need to display it as normal
        //if the test has no date and time, we need to display it as normal
        $upcoming = false;
        if($test->testDateTime != null)
        {
            //check to see if the test date and time is in the future
            $testDateTime = new DateTime($test->testDateTime);

            //get the current date and time
            $currentDateTime = new DateTime();

            
            if($testDateTime > $currentDateTime)
            {
                $upcoming = true;
            } 
        }

        //if test has an assignedID, it is a personal test, and we need to display it as such
        if($test->assignedID != null)
        {
            $personalMsg = "(Self-Assigned by: " . $test->assignedID . ") ";
        }
        else
        {
            $personalMsg = "";
        }

        //if upcoming, give card upcomingTest class

        if($upcoming)
        {
            echo "<div id='card' class='upcomingTest card testCards'>";
        }
        else
        {
            echo "<div id='card' class='activeTest card testCards'>";
        }

        echo "<div id='card-body' class='card-body'>";

        if($upcoming)
        {
            echo "<h5 class='card-title'>" . $personalMsg  . "Upcoming Test: " . $test->title . "</h5>";
        }
        else
        {
            echo "<h5 class='card-title'>" . $personalMsg  . $test->title . "</h5>";
        }

        //Shows the subject of the test
        echo "<p class='card-text'>Subject: " . $test->subject . "</p>";

        //Shows the Description of the test
        echo "<div class='card-text testDescriptionWrap'>";

        echo "<p class='testDescription'>" . $test->testDesc . "</p>";
        
        echo "</div>";
    
        //Shows the number of questions in the test
        echo "<p class='card-text'>Number of Questions: " . sizeof($test->questions) . "</p>";

        if($upcoming)
        {
            echo "<p class='card-text'>Available from: " . $test->testDateTime . "</p>";
        }
    
        //adds modify button to end of table with ID the same as the current testID of the test
        echo "<a href='#' class='modifyTestButton btn btn-primary' data-bs-toggle='modal' data-bs-target='#createTestModal' id='" . $test->testID . "'>Modify</a>";
    
        //adds Delete button to end of table with ID the same as the current testID of the test
        echo "<a href='#' class='deleteTestButton btn btn-danger' id='" . $test->testID . "'>Delete</a>";
    
        echo "</div>";
        echo "</div>";
    }

?>