<?php
$activatedPage = "Test Selection";
//include the header partial
include_once($_SERVER['DOCUMENT_ROOT'] . '/content/partials/header.php');
?>

<body class="d-flex flex-column h-100">
    <!-- Main Content -->
    <div class="container-fluid text-center">
        <!-- New Test Selection Area -->
        <div class="row">
            <div class="col-12">
                <h1 class="display-4 mt-5">Test Selection</h1>
                <p class="lead">Please select a test to take or create a test</p>
                <button type="button" class="btn btn-primary mx-3" data-bs-toggle="modal" data-bs-target="#createTestModal">Create Test</button>

                <!-- Modal -->
                <div class="modal fade" id="createTestModal" tabindex="-1" aria-labelledby="testNameLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="testNameLabel">New Test</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="createTestForm">
                                    <div class="mb-3">
                                        <label for="testName" class="form-label">Test Name</label>
                                        <input type="text" class="form-control" id="testName" name="testName" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="testDescription" class="form-label">Test Description</label>
                                        <textarea class="form-control" id="testDescription" name="testDescription" required></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="testSubject" class="form-label">Subject</label>
                                        <select class="form-select" id="testSubject" name="testSubject" required>
                                            <option value="" selected disabled>Select a Subject</option>
                                        </select>
                                    </div>
                                    <!-- add a date/time section which can be enabled and disabled through a tickbox, the tickbox is inline with the date/time input -->
                                    <div class="mb-3">
                                        <label for="testDateTime" class="form-label">Test Date & Time</label>
                                        <input type="datetime-local" class="form-control" id="testDateTime" name="testDateTime" required disabled>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="enableDateTime" name="enableDateTime">
                                            <label class="form-check-label" for="enableDateTime">Enable Date & Time</label>
                                        </div>
                                    </div>

                                    <div class="accordion accordion-flush" id="accordionFlush">
                                        <div class="accordion-item" id="questionAccordionItem">
                                            <h2 class="accordion-header" id="flush-heading1">
                                                <div class="d-flex align-items-center questionAccordionButtonContainer">
                                                    <button class="accordion-button collapsed flex-grow-1" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse1" aria-expanded="false" aria-controls="flush-collapse1">
                                                        Question 1
                                                    </button>
                                                </div>
                                            </h2>
                                            <div id="flush-collapse1" class="accordion-collapse collapse" aria-labelledby="flush-heading1" data-bs-parent="#accordionFlush">
                                                <div class="accordion-body">
                                                    <div class="mb-3">
                                                        <label class="form-label">Question</label>
                                                        <input type="text" class="form-control questions" data-question="1" name="question" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Answer 1</label>
                                                        <input type="text" class="form-control answers" data-question="1" name="answer" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Answer 2</label>
                                                        <input type="text" class="form-control answers" data-question="1" name="answer" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Answer 3</label>
                                                        <input type="text" class="form-control answers" data-question="1" name="answer" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Answer 4</label>
                                                        <input type="text" class="form-control answers" data-question="1" name="answer" required>
                                                    </div>
                                                    <input class="form-check-input answerRadio1" type="radio" name="isCorrect1" data-question="1" checked>
                                                    <label class="form-check-label" for="isCorrect1">Answer 1</label>
                                                    <input class="form-check-input answerRadio2" type="radio" name="isCorrect1" data-question="1">
                                                    <label class="form-check-label" for="isCorrect1">Answer 2</label>
                                                    <input class="form-check-input answerRadio3" type="radio" name="isCorrect1" data-question="1">
                                                    <label class="form-check-label" for="isCorrect1">Answer 3</label>
                                                    <input class="form-check-input answerRadio4" type="radio" name="isCorrect1" data-question="1">
                                                    <label class="form-check-label" for="isCorrect1">Answer 4</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- allow the user to add more questions -->
                                    <button type="button" class="btn btn-primary" id="addQuestion">Add Question</button>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" id="submitForm">Add Test</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <hr class="my-4">

        <!-- Test Cards -->
        <div id="testContainer" class="row">
            <!-- BASIC TEST CARD TEMPLATE -->
            <!-- <div class="col-sm-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Test 1</h5>
                        <p class="card-text">Test Description</p>
                    </div>
                    <div class="card-footer">
                        <a href="test.php" class="btn btn-primary">Start Test</a>
                    </div>
                </div>
            </div> -->
            <!-- END BASIC TEST CARD TEMPLATE -->

            <!-- PHP GENERATED TEST CARDS WILL BE POPULATED HERE. 
            AJAX request queries retrieveTests.php to retrieve custom test cards -->

        </div>

        <!-- Completed Test Cards -->
        <div class="row">
            <div class="col-12">
                <h1 class="display-4 mt-5">Completed Tests</h1>
                <p class="lead">View your completed tests</p>
            </div>
        </div>

        <hr class="my-4">

        <div id="completedTestContainer" class="row mb-5">

            <!--PHP GENERATED COMPLETED TEST CARDS WILL BE POPULATED HERE.
        AJAX request queries retrieveCompletedTests.php to retrieve custom test cards -->

        </div>
    </div>
<!-- End Main Content -->

<?php
//include the footer partial
include_once($_SERVER['DOCUMENT_ROOT'] . '/content/partials/footer.php');
?>
