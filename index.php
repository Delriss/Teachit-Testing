<?php

require_once("jRoute/_load.php");

//Create jRoute instance
$jRoute = new jRoute();

//Add index route
$jRoute->Route(["get"], "/", "content/index.php");

//Create login Route
$jRoute->Route(["get"], "/login", "content/login.php");

//Create Logout Route
$jRoute->Route(["get"], "/logout", "php/logout.php");

//Create register Route
$jRoute->Route(["get"], "/register", "content/registration.php");

//Create Test Selection Route
$jRoute->Route(["get"], "/test-selection", "content/test-selection.php");

//(fix) NEEDS AUTH WHEN IT HAS BEEN BUILT
$jRoute->Route(["get"], "/test-management", "content/secure-lecturer/test-management.php");

//
//PRIVATE PHP ROUTES
//

//Create readEnvVars route
$jRoute->Route(["post"], "/php/readEnvVars", "php/readEnvVars.php");

//Create connect file route
$jRoute->Route(["post"], "/php/connect", "php/_connect.php");

//Create auth route
$jRoute->Route(["post"], "/php/auth", "php/auth.php");

//Create outputStudentsTests route
$jRoute->Route(["post"], "/php/outputStudentTests", "php/outputStudentTests.php");

//Create outputCompletedStudentsTests route
$jRoute->Route(["post"], "/php/outputCompletedStudentTests", "php/outputCompletedStudentTests.php");

//Create outputTests route
$jRoute->Route(["post"], "/php/outputTests", "php/outputTests.php");

//Create retrieveTests route
$jRoute->Route(["post"], "/php/retrieveTests", "php/retrieveTests.php");

//Create retrieveTestData route
$jRoute->Route(["post"], "/php/retrieveTestData", "php/retrieveTestData.php");

//Create retrieveSubjects route
$jRoute->Route(["post"], "/php/retrieveSubjects", "php/retrieveSubjects.php");

//Create createTest route
$jRoute->Route(["post"], "/php/createTest", "php/createTest.php", requiredRole: "authorisedUser");

//Create modifyTest route
$jRoute->Route(["post"], "/php/modifyTest", "php/modifyTest.php", requiredRole: "authorisedUser");

//Create createUser route
$jRoute->Route(["post"], "/php/createUser", "php/createUser.php");

//Create deleteTest route
$jRoute->Route(["post"], "/php/deleteTest", "php/deleteTest.php", requiredRole: "authorisedUser");

//Dispatch the route
echo $jRoute->Dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
