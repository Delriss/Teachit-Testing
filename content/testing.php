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

    <title>Testing - TeachIt Testing</title>

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
                        <a class="nav-link active" aria-current="page" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/test-selection">Test Selection</a>
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
    <div class="col-lg-6 mt-auto mx-auto p-3 py-md-3 text-center rounded bgColourFaded">
        <div class="text-center" id="testingInterface">

            <!-- <div class="testingQuestion" id="question-text">
                <h3>Temporary question text which is an example on how a question will look like on the testing page.</h3>
            </div>
            <hr>
            <form id="testingForm">
                <div id="testingOption1">
                    <p class="testingOption">Option 1:</p>
                    <button type="submit" class="btn btn-dark rounded-pill" id="option1">This is an example of how an answer to a question will look on the testing page.</button>
                    <hr>
                </div>
                <div id="testingOption2">
                    <p class="testingOption">Option 2:</p>
                    <button type="submit" class="btn btn-dark rounded-pill" id="option2">This is an example of how a very answer to a question will look on the testing page. This answer is very long and complex, and it shows how much text can possibly be in the answer box compared to really short answers like the one below.</button>
                    <hr>
                </div>
                <div id="testingOption3">
                    <p class="testingOption">Option 3:</p>
                    <button type="submit" class="btn btn-dark rounded-pill" id="option3">Short answer.</button>
                    <hr>
                </div>
                <div id="testingOption4">
                    <p class="testingOption">Option 4:</p>
                    <button type="submit" class="btn btn-dark rounded-pill" id="option4">This is an example of how an answer to a question will look on the testing page.</button>
                    <hr>
                </div>
                <p>Click on a button to submit your answer.</p>
                <button type="submit" class="btn btn-primary rounded-pill">Submit</button>
            </form> -->
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

</html>