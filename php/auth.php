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
		//if the email does not match any users in the database
		echo "e1-No_User_Found";
	}
	else {
		//If the email does match a user in the database
		$result = mysqli_fetch_assoc($run);

		if (password_verify($password, $result["password"])) {
			$_SESSION["ID"] = $result["ID"];
			$_SESSION["email"] = $result["email"];

			//will likely change this to the accessLevel in the database later on for admin purposes
			$_SESSION["auth"] = true;

			echo "e3-Login_Successful";

		} else {
			//If the password does not match the email
			echo "e2-Password_Incorrect";
		}
	}
}


?>