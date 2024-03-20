<?php

require_once("jRoute/_load.php");

//Students = 0, Lecturers = 1, Admins = 2 

//Create jRoute instance
$jRoute = new jRoute();

//Add index route
$jRoute->Route(["get"], "/", "content/index.php");

//Create login Route
$jRoute->Route(["get"], "/login", "content/login.php");

//only logged in users can access logout
//Create Logout Route
$jRoute->Route(["get"], "/logout", "php/logout.php");

//Create register Route
$jRoute->Route(["get"], "/register", "content/registration.php");

//all logged in users can access test selection
//Create Test Selection Route
$jRoute->Route(["get"], "/test-selection", "content/test-selection.php", [0,1,2]);

//Create Testing Page Route
$jRoute->Route(["get"], "/testing", "content/testing.php", [0,1,2]);

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

//removed readEnvVars route as this poses an enormous security risk and is never POSTed to from the client side, only used in the backend

//Create connect file route
$jRoute->Route(["post"], "/includes/connect", "php/_connect.php");

//Create auth route
$jRoute->Route(["post"], "/includes/auth", "php/auth.php");

//Create outputStudentsTests route
$jRoute->Route(["post"], "/includes/outputStudentTests", "php/outputStudentTests.php", [0,1,2]);

//Create outputCompletedStudentsTests route
$jRoute->Route(["post"], "/includes/outputCompletedStudentTests", "php/outputCompletedStudentTests.php", [0,1,2]);

//Create outputTests route
$jRoute->Route(["post"], "/includes/outputTests", "php/outputTests.php", [1,2]);

//Create retrieveTests route
$jRoute->Route(["post"], "/includes/retrieveTests", "php/retrieveTests.php", [0,1,2]);

//Create retrieveTestData route
$jRoute->Route(["post"], "/includes/retrieveTestData", "php/retrieveTestData.php", [0,1,2]);

//Create retrieveSubjects route
$jRoute->Route(["post"], "/includes/retrieveSubjects", "php/retrieveSubjects.php");

//Create createTest route
$jRoute->Route(["post"], "/includes/createTest", "php/createTest.php", [1,2]);

//Create modifyTest route
$jRoute->Route(["post"], "/includes/modifyTest", "php/modifyTest.php", [1,2]);

//Create createUser route
$jRoute->Route(["post"], "/includes/createUser", "php/createUser.php");

//Create deleteTest route
$jRoute->Route(["post"], "/includes/deleteTest", "php/deleteTest.php", [1,2]);

//Create initialiseTest route
$jRoute->Route(["post"], "/includes/initialiseTest", "php/initialiseTest.php");

//Create nextQuestion route
$jRoute->Route(["post"], "/includes/nextQuestion", "php/nextQuestion.php");

//Create validateAnswer route
$jRoute->Route(["post"], "/includes/validateAnswer", "php/validateAnswer.php");

//Create finaliseTest route
$jRoute->Route(["post"], "/includes/finaliseTest", "php/finaliseTest.php");

//Dispatch the route
echo $jRoute->Dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
