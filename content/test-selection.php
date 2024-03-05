<?php
if ($_SESSION['LoggedIn'] == false) {
    header("Location: /login");
    die();
}
?>


<!DOCTYPE html>
<html class="h-100" lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="SEF">

    <title>Test Selection - TeachIt Testing</title>

    <!-- Stylesheets -->
    <link rel="stylesheet" href="../content/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <!-- End Stylesheets -->
</head>

<body class="d-flex flex-column h-100">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bgColour">
        <!-- Nav Container - adapt to screen size -->
        <div class="container-fluid">
            <a class="navbar-brand" href="/">
                <img src="../content/imgs/logo-side.png" alt="TeachIt Testing" width="200" height="50">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapsable" aria-controls="navbarCollapsable" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapsable">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="/test-selection">Test Selection</a>
                    </li>
                    <li class="nav-item dropdown bgColour">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Admin Dashboard
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">Student Management</a></li>
                            <li><a class="dropdown-item" href="#">Test Management</a></li>
                            <li><a class="dropdown-item" href="#">Lecturer Management</a></li>
                            <li><a class="dropdown-item" href="#">Statistics</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/logout">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- End Nav Container -->
    </nav>
    <!-- End Navbar -->

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

    <!-- Footer -->
    <footer class="footer mt-auto py-3 rounded-top bgColour">
        <div class="container text-center">
            <span class="text-muted">TeachIt Testing &copy; 2021</span>
        </div>
    </footer>
    <!-- End Footer -->

    <!-- Background Circles -->
    <ul class="circles">
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
    </ul>
    <!-- End Background Circles -->



</body>
<!-- JS -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="../content/js/scripts.js"></script>
<script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
<script src="../content/js/test-management.js"></script>

</html>