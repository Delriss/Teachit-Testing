<?php
//File Security Check to avoid direct access
if (!isset($_SESSION)) {
    header("Location: /login");
    die('<p class="lead">User is not logged in.</p>');
}


require_once("./_connect.php");
require_once("./retrieveTests.php");

foreach ($testArray as $test) {
    echo ('<div class="col-sm-4 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">' . $test->title . '</h5>
                    <p class="card-text">' . $test->subject . ' - ' . count($test->questions) . ' Questions</p>
                    <hr>
                    <p class="card-text">' . $test->testDesc . '</p>
                </div>
                <div class="card-footer">
                    <a href="test.php" class="btn btn-primary">Start Test</a>
                </div>
            </div>
        </div>
    ');
};

?>