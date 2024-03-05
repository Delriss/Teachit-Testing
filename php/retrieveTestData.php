<?php

//retrieving test data from the database with specific testID
if (isset($_POST['testID'])){
    //define $testID
    $testID = $_POST['testID'];

    //include retrieveTests.php
    include_once($_SERVER['DOCUMENT_ROOT'].'/php/retrieveTests.php');

    foreach ($testArray as $test){
        if ($test->testID == $testID){
            echo (json_encode($test));
        }
    }
}