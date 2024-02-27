<?php
//If not accessed via POST, refuse access - POST will only be via router/JS
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
	//If the request is not a POST request, the user will be redirected to the login page
	header("Location: /");
	die();
}

require_once($_SERVER['DOCUMENT_ROOT'].'/php/readEnvVars.php');

GetSettings();

$db_server = $_ENV['DB_HOST'];
$db_user = $_ENV['DB_USER'];
$db_password = $_ENV['DB_PASS'];
$db_database = $_ENV['DB_NAME'];


//connect to database server
$db_connect = mysqli_connect($db_server,$db_user,$db_password,$db_database)

?>