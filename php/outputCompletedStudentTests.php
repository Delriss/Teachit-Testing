<?php
//File Security Check to avoid direct access
if (!isset($_SESSION)) {
    die('<p class="lead">User is not logged in.</p>');
}

include_once($_SERVER['DOCUMENT_ROOT'] . '/php/_connect.php');

//Get Completed Tests for current user
$sql = "SELECT `TID`, `score`, `timestamp` FROM `userTests` WHERE `UID` = ?";
$stmt = mysqli_prepare($db_connect, $sql);
mysqli_stmt_bind_param($stmt, "i", $_SESSION['UID']);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

//Check if there are any completed tests
if (mysqli_num_rows($result) == 0) {
    echo ('<div class="col-12">
            <p class="lead">You have not completed any tests yet</p>
        </div>');
    return;
} else {
    //Store the completed tests in an array
    $completedTests = array();
    $completedTests = mysqli_fetch_all($result, MYSQLI_ASSOC);

    //Get the test details for each test
    foreach ($completedTests as &$test) {
        $sql = "SELECT `title`, `testDesc`, `subject` FROM `tests` WHERE `testID` = ?";
        $stmt = mysqli_prepare($db_connect, $sql);
        mysqli_stmt_bind_param($stmt, "i", $test['TID']);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $testDetails = mysqli_fetch_assoc($result);

        //Add the test details to the completed test array
        $test['title'] = $testDetails['title'];
        $test['testDesc'] = $testDetails['testDesc'];
        $test['subjectID'] = $testDetails['subject']; // Store subject ID for later retrieval
    }

    //Get the subject names for each test
    foreach ($completedTests as &$test) {
        $sql = "SELECT `subjectName` FROM `subjects` WHERE `SID` = ?";
        $stmt = mysqli_prepare($db_connect, $sql);
        mysqli_stmt_bind_param($stmt, "i", $test['subjectID']);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $subject = mysqli_fetch_assoc($result);

        // Add subject name to the completed test array
        $test['subject'] = $subject['subjectName'];
    }

    //Output the completed tests
    foreach ($completedTests as $test) {
        echo ('<div class="col-sm-4 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">' . $test['title'] . '</h5>
                    <p class="card-text">' . $test['subject'] . ' - ' . $test['timestamp'] . '</p>
                    <hr>
                    <p class="card-text">' . $test['testDesc'] . '</p>
                </div>
                <div class="card-footer">
                    <p class="btn btn-primary">Score: ' . $test['score'] . '</p>
                </div>
            </div>
        </div>
    ');
    }
}
?>
