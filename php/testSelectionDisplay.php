<?php

require_once("./_connect.php");
require_once("./retrieveTests.php");

foreach ($testArray as $test) {
    echo ('<div class="col-sm-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">' . $test->title . '</h5>
                    <p class="card-text">' . $test->testDesc . '</p>
                </div>
                <div class="card-footer">
                    <a href="test.php" class="btn btn-primary">Start Test</a>
                </div>
            </div>
        </div>
    ');
};
