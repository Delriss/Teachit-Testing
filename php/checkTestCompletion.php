<?php

//This file will check if the test has been completed so we can warn the user before deleting it.
//check if there is user session

if (!isset($_SESSION['user'])){
    //if not, return to the login page
    header("Location: /login");
}
    
if(isset($_POST["testID"]))
{
    include_once($_SERVER['DOCUMENT_ROOT'].'/php/_connect.php'); 
    $testID = mysqli_real_escape_string($db_connect,$_POST["testID"]);

    $sql = "CALL selectCompletedTestsFromTestID(?)";
    //prepare the sql statement
    $stmt = $db_connect->prepare($sql); 
    $stmt->bind_param("i", $testID);
    $stmt->execute();
    $stmt->store_result();
    $completed = $stmt->num_rows;

    //if the amount of rows is greater than 0, then the test has been completed
    if($completed > 0)
    {
        echo "true";
    }
    else
    {
        echo "false";
    }
}
else
{
    die("Error: Test ID not set");
}