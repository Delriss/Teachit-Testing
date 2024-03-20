<?php

//this is going to be passed the testID so we know which test to modify.
//it will then delete the test from the database and then call the createTest.php file to create the test again.
//it will then update the test with the old testID
//this is not the best way to do this, but we are under time constraints and this is the best way to do it with the time we have.

//check if there is user session
if (!isset($_SESSION['user'])){
    //if not, return to the login page
    header("Location: /login");
}
//check if all needed post data is set
//validate post data
if (!isset($_POST['testID']) || !isset($_POST['testTitle']) || !isset($_POST['testDescription']) || !isset($_POST['testSubject']) || !isset($_POST['questions'])) {
    echo "Test Creation Failed: Missing Data";
    exit();
}

//Include the database connection
include_once($_SERVER['DOCUMENT_ROOT'] . '/php/_connect.php');

//Get the testID from the form whilst escaping it
$oldTestID = mysqli_real_escape_string($db_connect, $_POST['testID']);

//if the testID is not in the database, echo an error and exit
if (!$oldTestID) {
    echo "Error: Test ID not found";
    exit();
}

//delete all questions associated with the test, this will also delete all answers associated with the questions as they have a foreign key constraint
$sql = "DELETE FROM tests WHERE testID = ?";
$stmt = $db_connect->prepare($sql);
$stmt->bind_param("i", $oldTestID);
if (!$stmt->execute()) {
    die("Error: " . $stmt->error);
}

//include the createTest.php file to create the test again
include_once($_SERVER['DOCUMENT_ROOT'] . '/php/createTest.php');

//get the testID of the last inserted test
$newTestID = mysqli_insert_id($db_connect);

//update the test with the old testID
$sql = "UPDATE tests SET testID = ? WHERE testID = ?";
$stmt = $db_connect->prepare($sql);
$stmt->bind_param("ii", $oldTestID, $testID);
if (!$stmt->execute()) {
    die("Error: " . $stmt->error);
}

//echo success
echo "Test Modified Successfully";
