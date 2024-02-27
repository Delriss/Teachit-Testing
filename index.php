<?php

require_once("jRoute/_load.php");

//Create jRoute instance
$jRoute = new jRoute();

//Add index route
$jRoute->Route(["get"], "/", function() {
    echo "Hello World!";
});


//Create Index Route
$jRoute->Route(["get"], "/", "content/index.php");

//Create Login Route
$jRoute->Route(["get"], "/login", "content/login.php");

//Create register Route
$jRoute->Route(["get"], "/register", "content/registration.php");

//Create Test Selection Route
$jRoute->Route(["get"], "/test-selection", "content/test-selection.php");

//(fix) NEEDS AUTH WHEN IT HAS BEEN BUILT
$jRoute->Route(["get"], "/test-management", "content/secure-lecturer/test-management.php");

echo $jRoute->Dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
