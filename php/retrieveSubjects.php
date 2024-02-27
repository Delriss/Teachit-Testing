<?php
//If not accessed via POST, refuse access - POST will only be via router/JS
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
	//If the request is not a POST request, the user will be redirected to the login page
	header("Location: /");
	die();
}

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