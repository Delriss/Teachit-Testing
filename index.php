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

//Create Student Management Route
$jRoute->Route(["get"], "/student-management", "content/secure-lecturer/student-management.php");

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
$jRoute->Route(["post"], "/php/createTest", "php/createTest.php");

//Create modifyTest route
$jRoute->Route(["post"], "/php/modifyTest", "php/modifyTest.php");

//Create createUser route
$jRoute->Route(["post"], "/php/createUser", "php/createUser.php");

//Create deleteTest route
$jRoute->Route(["post"], "/php/deleteTest", "php/deleteTest.php", requiredRole: "authorisedUser");

//Create outputStudents route
$jRoute->Route(["post"], "/php/outputStudents", "php/outputStudents.php");

//Create deleteUser route
$jRoute->Route(["post"], "/php/deleteUser", "php/deleteUser.php");

//Create lockUser route
$jRoute->Route(["post"], "/php/lockUser", "php/lockUser.php");

//Create addStudent route
$jRoute->Route(["post"], "/php/addStudent", "php/addStudent.php");

//Create editStudent route
$jRoute->Route(["post"], "/php/editStudent", "php/editStudent.php");

//Create retrieveStudentData route
$jRoute->Route(["post"], "/php/retrieveStudentData", "php/retrieveStudentData.php");

//Create resetPassword route
$jRoute->Route(["post"], "/php/resetPassword", "php/resetPassword.php");

//Dispatch the route
echo $jRoute->Dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
