<?php

require_once("jRoute/_load.php");

//Students = 0, Lecturers = 1, Admins = 2 

//Create jRoute instance
$jRoute = new jRoute();

//add public directory for static files
$jRoute->AddDir("/public", __DIR__ . "./public_static/");

//Add index route
$jRoute->Route(["get"], "/", "content/index.php");

//Create login Route
$jRoute->Route(["get"], "/login", "content/login.php");

//only logged in users can access logout
//Create Logout Route
$jRoute->Route(["get"], "/logout", "php/logout.php", [0,1,2]);

//Create register Route
$jRoute->Route(["get"], "/register", "content/registration.php");

//all logged in users can access test selection
//Create Test Selection Route
$jRoute->Route(["get"], "/test-selection", "content/test-selection.php", [0,1,2]);

//lecturer and admin can access test management
//Create Test Management Route
$jRoute->Route(["get"], "/test-management", "content/secure-lecturer/test-management.php", [1,2]);

//all logged in users can access the leaderboard
//Create Leaderboard Route
$jRoute->Route(["get"], "/leaderboard", "content/leaderboard.php", [0,1,2]);

//Theo Pages
//lecturers and admins can access student management
$jRoute->Route(["get"], "/student-management", "content/placeholder.php", [1,2]);
//only admins can access lecturer management
$jRoute->Route(["get"], "/lecturer-management", "content/placeholder.php", [2]);
//admins and lecturers can access statistics
$jRoute->Route(["get"], "/statistics", "content/placeholder.php", [1,2]);

//
//PRIVATE PHP ROUTES
//

//Create readEnvVars route
$jRoute->Route(["post"], "/includes/readEnvVars", "php/readEnvVars.php");

//Create connect file route
$jRoute->Route(["post"], "/includes/connect", "php/_connect.php");

//Create auth route
$jRoute->Route(["post"], "/includes/auth", "php/auth.php");

//Create outputStudentsTests route
$jRoute->Route(["post"], "/includes/outputStudentTests", "php/outputStudentTests.php");

//Create outputCompletedStudentsTests route
$jRoute->Route(["post"], "/includes/outputCompletedStudentTests", "php/outputCompletedStudentTests.php");

//Create outputTests route
$jRoute->Route(["post"], "/includes/outputTests", "php/outputTests.php");

//Create retrieveTests route
$jRoute->Route(["post"], "/includes/retrieveTests", "php/retrieveTests.php");

//Create retrieveTestData route
$jRoute->Route(["post"], "/includes/retrieveTestData", "php/retrieveTestData.php");

//Create retrieveSubjects route
$jRoute->Route(["post"], "/includes/retrieveSubjects", "php/retrieveSubjects.php");

//Create createTest route
$jRoute->Route(["post"], "/includes/createTest", "php/createTest.php");

//Create modifyTest route
$jRoute->Route(["post"], "/includes/modifyTest", "php/modifyTest.php");

//Create createUser route
$jRoute->Route(["post"], "/includes/createUser", "php/createUser.php");

//Create deleteTest route
$jRoute->Route(["post"], "/includes/deleteTest", "php/deleteTest.php");

//Dispatch the route
echo $jRoute->Dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
