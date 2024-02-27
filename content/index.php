<!DOCTYPE html>
<html class="h-100" lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="SEF">

    <title>TeachIt Testing</title>

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
    <div class="container-fluid text-center">
        <div class="row homeContainer mb-5">
            <div class="col-12 d-flex flex-column justify-content-center">
                <h1 class="display-1">Welcome to TeachIt Testing</h1>
                <p class="indexDescription fs-4 mt-5">TeachIt Testing is an online testing program which utilises reinforcement testing to help you learn in a fun and competitive manner!</p>
                <a class="text-black subtitle fs-4 text-decoration-underline mt-1" href="registration.php">Click here to get started today!</a>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="d-flex flex-column align-items-center justify-content-end indexScrollDown">
                    <p>Scroll Down</p>
                    <i class="fas fa-chevron-down fa-2x"></i>
                </div>
            </div>
        </div>

        <div class="row homeFeaturesContainer mt-5">
            <div class="col-12">
                <h1 class="display-3 py-3">Features</h1>
            </div>
            <!-- Features Section -->
            <div class="col-sm-6 mb-5">
                <div class="homeFeature">
                    <h3>Track Your Progress</h3>
                    <p>You can track your progress on the different subjects since all test results are saved to the student dashboard. This can help students figure out what they need to revise.</p>
                </div>
            </div>

            <div class="col-sm-6 mb-5">
                <div class="homeFeature">
                    <h3>Support For Additional Subjects</h3>
                    <p>Lecturers can add additional subjects to TeachIT Testing, as well as adding questions onto previous subjects. This will keep each topic up to date and allow students to further test their knowledge.</p>
                </div>
            </div>

            <div class="col-sm-6 mb-5">
                <div class="homeFeature">
                    <h3>Leaderboards For Each Subject</h3>
                    <p>Each subject has a leaderboard which will show the top 5 students. Excel in your learning and aim for the top!</p>
                </div>
            </div>

            <div class="col-sm-6 mb-5">
                <div class="homeFeature">
                    <h3>Instant Results</h3>
                    <p>You will recieve your test results as soon as you have finished the test, it does not require lecturers to mark it. You will be able to see which questions you got right or wrong to help you revise for that topic.</p>
                </div>
            </div>
        </div>
    </div>
        <!-- End Main Content -->

        <!-- Footer -->
        <footer class="footer mt-auto py-3 rounded-top bgColour">
            <div class="container text-center">
                <span class="text-muted">Contact us at: SEF@ucw.ac.uk - 07123 123123</span> <br>
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