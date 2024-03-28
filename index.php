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

//Create Privacy Policy Route
$jRoute->Route(["get"], "/privacy-policy", "content/privacy-policy.php");

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

//Create Student Management Route
$jRoute->Route(["get"], "/student-management", "content/secure-lecturer/student-management.php");

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
$jRoute->Route(["post"], "/includes/createTest", "php/createTest.php", [0,1,2]);

//Create modifyTest route
$jRoute->Route(["post"], "/includes/modifyTest", "php/modifyTest.php", [1,2]);

//Create createUser route
$jRoute->Route(["post"], "/includes/createUser", "php/createUser.php");

//create checkTestCompletion route
$jRoute->Route(["post"], "/includes/checkTestCompletion", "php/checkTestCompletion.php", [0,1,2]);

//Create deleteTest route
$jRoute->Route(["post"], "/includes/deleteTest", "php/deleteTest.php", [1,2]);

//Create initialiseTest route
$jRoute->Route(["post"], "/includes/initialiseTest", "php/initialiseTest.php", [0,1,2]);

//Create nextQuestion route
$jRoute->Route(["post"], "/includes/nextQuestion", "php/nextQuestion.php", [0,1,2]);

//Create validateAnswer route
$jRoute->Route(["post"], "/includes/validateAnswer", "php/validateAnswer.php", [0,1,2]);

//Create finaliseTest route
$jRoute->Route(["post"], "/includes/finaliseTest", "php/finaliseTest.php", [0,1,2]);

//Create outputStudents route
$jRoute->Route(["post"], "/includes/outputStudents", "php/outputStudents.php", [0,1,2]);

//Create deleteUser route
$jRoute->Route(["post"], "/includes/deleteUser", "php/deleteUser.php", [1,2]);

//Create lockUser route
$jRoute->Route(["post"], "/includes/lockUser", "php/lockUser.php", [1,2]);

//Create addStudent route
$jRoute->Route(["post"], "/includes/addStudent", "php/addStudent.php", [1,2]);

//Create editStudent route
$jRoute->Route(["post"], "/includes/editStudent", "php/editStudent.php", [1,2]);

//Create retrieveStudentData route
$jRoute->Route(["post"], "/includes/retrieveStudentData", "php/retrieveStudentData.php" , [1,2]);

//Create resetPassword route
$jRoute->Route(["post"], "/includes/resetPassword", "php/resetPassword.php", [1,2]);

//Dispatch the route
echo $jRoute->Dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
