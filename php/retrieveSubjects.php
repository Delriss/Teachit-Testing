<?php

//Connect to DB
require_once($_SERVER['DOCUMENT_ROOT'].'/php/_connect.php');

//Retrieve subjects info from DB
$sql = "SELECT * FROM `subjects`"; 
$stmt = mysqli_prepare($db_connect, $sql); //Prepare SQL statement
mysqli_stmt_execute($stmt); 
$result = mysqli_stmt_get_result($stmt); //Get results from prepared statement

//Output results as JSON for JS processing
$subjects = array();
while($row = mysqli_fetch_assoc($result)) {
    $subjects[] = $row;
}

//Return JSON Data
echo json_encode($subjects);
?>