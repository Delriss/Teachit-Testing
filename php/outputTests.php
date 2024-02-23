<?php

include_once($_SERVER['DOCUMENT_ROOT'].'/php/retrieveTests.php');

//Function to display the tests in the database as cards{
    foreach ($testArray as $test){

        echo "<div id='card' class='card'>";
        echo "<div id='card-body' class='card-body'>";
    
        //Shows the title of the test
        echo "<h5 class='card-title'>" . $test->title . "</h5>"; 

        //Shows the subject of the test
        echo "<p class='card-text'>Subject: " . $test->subject . "</p>";

        //Shows the Description of the test
        echo "<p class='card-text'>" . $test->testDesc . "</p>";
    
        //Shows the number of questions in the test
        echo "<p class='card-text'>Number of Questions: " . sizeof($test->questions) . "</p>";
    
        //adds modify button to end of table with ID the same as the current testID of the test
        echo "<a href='#' class='modifyTestButton btn btn-primary' data-bs-toggle='modal' data-bs-target='#createTestModal' id='" . $test->testID . "'>Modify</a>";
    
        //adds Delete button to end of table with ID the same as the current testID of the test
        echo "<a href='#' class='deleteTestButton btn btn-danger' id='" . $test->testID . "'>Delete</a>";
    
        echo "</div>";
        echo "</div>";
    }

?>