<?php
//If not accessed via POST, refuse access - POST will only be via router/JS
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
	//If the request is not a POST request, the user will be redirected to the login page
	header("Location: /");
	die();
}

//File Security Check to avoid direct access
if (!isset($_SESSION)) {
    die('<p class="lead">User is not logged in.</p>');
}


include_once($_SERVER['DOCUMENT_ROOT'] . '/php/_connect.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/php/retrieveTests.php');

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
                    <form id="testForm">
                        <input type="hidden" id="testID" value="' . $test->testID . '">
                        <button type="submit" class="btn btn-primary">Start Test</button>
                    </form>
                </div>
            </div>
        </div>
    ');
};

?>