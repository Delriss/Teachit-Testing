<?php

require_once("jRoute/_load.php");

//Create jRoute instance
$jRoute = new jRoute();

//Add index route
$jRoute->Route(["get"], "/", function() {
    echo "Hello World!";
});


//Create currency Route
$jRoute->Route(["get"], "/", "content/login.php");

//(fix) NEEDS AUTH WHEN IT HAS BEEN BUILT
$jRoute->Route(["get"], "/test-management", "content/secure-lecturer/test-management.php");

echo $jRoute->Dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
