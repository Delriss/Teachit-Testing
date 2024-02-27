<?php
session_start();

//If not accessed via POST, refuse access - POST will only be via router/JS
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
	//If the request is not a POST request, the user will be redirected to the login page
	header("Location: /");
	die();
}

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
		//if the email does not match any users in the database, this will send a sweet alert to inform the user
		echo "e1";
	}
	else {
		//If the email does match a user in the database
		$result = mysqli_fetch_assoc($run);

		if (password_verify($password, $result["password"])) {
			//if the password is verified then the details will be stored in the database and the user will be logged in
			$_SESSION["ID"] = $result["ID"];
			$_SESSION["auth"] = $result["accessLevel"];
			$_SESSION["LoggedIn"] = true;

			//Adds the user's role to the session for use in routing
			if ($_SESSION["auth"] == 2) {
				$_SESSION["role"] = "admin";
			} else if ($_SESSION["auth"] == 1) {
				$_SESSION["role"] = "lecturer";
			} else {
				$_SESSION["role"] = "student";
			}
			
			//sends a sweet alert to the user to let them know they have logged in
			echo "e3";
		} else {
			//If the password does not match the email, sends a sweet alert to inform the user
			echo "e2";
		}
	}
} else {
	//If the username and password have not been entered, sends a sweet alert to inform the user
	echo "e4";
}


?>