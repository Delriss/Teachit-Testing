<?php
//create user class with properties
require_once("php/userClass.php");

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
	include_once($_SERVER['DOCUMENT_ROOT'] . '/php/_connect.php');

	//Check reCAPTCHA score
	require_once($_SERVER['DOCUMENT_ROOT'] . '/php/readEnvVars.php'); //Reads the environment variables from the .env file
	$captcha = $_POST['recapToken']; //Get the reCAPTCHA token from the POST request
	$secretKey = $_ENV["CAPTCHA_PRIVATE"]; //Get the reCAPTCHA secret key from the environment variables
	$reCAPTCHA = json_decode(file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) .  '&response=' . urlencode($captcha))); //Send a GET request to the reCAPTCHA API
	//Check if the reCAPTCHA score is less than 0.6 (60%)
	if ($reCAPTCHA->score <= 0.6) {
		die("Captcha Failed.");
	}

	//setting the username and password variables from the login form to use in verification
	$email = $_POST["email"];
	$password = $_POST["password"];

	//USING STORED PROCEDURES
	//	I am unable to test at uni so this code is commented out until I can test on my computer
	
	$stmt = $db_connect->prepare("CALL loginAuth(?)");
	$stmt->bind_param('s', $email);
	$stmt->execute();
	$run = $stmt->get_result();
	$stmt->close();
	
	$count = mysqli_num_rows($run);

	if ($count === 0) {
		//if the email does not match any users in the database, this will send a sweet alert to inform the user
		echo "e1";
	} else {
		//If the email does match a user in the database
		$result = mysqli_fetch_assoc($run);

		//Check if account is locked
		if ($result["accountLock"] == 1) {
			//If the account is locked, sends a sweet alert to inform the user
			echo "e5";
			exit();
		}

		if (password_verify($password, $result["password"])) {
			//if the password is verified then the details will be stored in the database and the user will be logged in
			//create a new user object
			$user = new User();
			$user->ID = $result["ID"];
			$user->email = $result["email"];
			$user->accessLevel = $result["accessLevel"];
			$user->loggedIn = true;

			//store the user object in the session
			$_SESSION["user"] = serialize($user);
			
			$_SESSION["ID"] = $result["ID"];
			$_SESSION["auth"] = $result["accessLevel"];
			$_SESSION["LoggedIn"] = true;

			//Adds the user's role to the session for use in routing
			if ($_SESSION["auth"] >= 1) {
				$_SESSION["role"] = "authorisedUser";
			}
			else {
				$_SESSION["role"] = "student";
			}

			//Updates DB for last login time
			$currentTime = date("Y-m-d H:i:s");
			$db_connect->next_result();
			$stmt = mysqli_prepare($db_connect, "CALL editLastLoginFromID(?, ?)");
			mysqli_stmt_bind_param($stmt, "is", $user->ID, $currentTime);
			mysqli_stmt_execute($stmt);

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
