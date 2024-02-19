<?php

session_start();

if (isset($_POST["email"]) and isset($_POST["password"])) { //if username and password have been enterred

	//connects to the database to verify login
	//Connect to DB
	include_once($_SERVER['DOCUMENT_ROOT'].'/php/_connect.php');

	//setting the username and password variables from the login form to use in verification
	$email = $_POST["email"];
	$password = $_POST["password"];

	$stmt = mysqli_prepare($db_connect, "SELECT * FROM `users` WHERE `email` = ?");
	mysqli_stmt_bind_param($stmt, "s", $email);
	mysqli_stmt_execute($stmt);
	$run = mysqli_stmt_get_result($stmt);

	$count = mysqli_num_rows($run);

	if ($count === 0) {

		die($count);
		header("Location: ../content/registration.php?e=1");
		die($count);
	}
	else {
		die($count);
		header("Location: ../content/login.php?e=2");
	}
}


?>