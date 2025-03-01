<?php
//check if there is user session
if (!isset($_SESSION['user'])){
    //if not, return to the login page
    header("Location: /login");
}


include_once($_SERVER['DOCUMENT_ROOT'] . '/php/_connect.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/php/retrieveTests.php');

////Change Request////
//Output the tests
foreach ($testArray as $test) {

    $upcoming = false;
    if ($test->testDateTime != null) {
        //check to see if the test date and time is in the future
        $testDateTime = new DateTime($test->testDateTime);

        //get the current date and time
        $currentDateTime = new DateTime();

        //Set the upcoming variable to true if the test date and time is in the future
        if ($testDateTime > $currentDateTime) {
            $upcoming = true;
        }
    }

    //If upcoming do not display the test else display the test
    if (!$upcoming) {
        //if assignedID is not null, the test is assigned to the user
        if ($test->assignedID != null) {
            $personalMsg = "Self-Assigned - ";

            //check if assignedID is equal to the current user's ID, if not, skip the test
            if ($test->assignedID != $_SESSION["ID"]) {
                continue;
            }
        }
        else{
            $personalMsg = "";
        }
        echo ('<div class="col-sm-4 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">' . $test->title . '</h5>
                        <p class="card-text">' . $personalMsg . $test->subject . ' - ' . count($test->questions) . ' Questions</p>
                        <hr>
                        <p class="card-text">' . $test->testDesc . '</p>
                    </div>
                    <div class="card-footer">
                        <button id="startTestButton" class="btn btn-primary testIDButton" data-id='. $test->testID .'>Start Test</button>
                    </div>
                    </div>
                </div>
    ');
    }
};
