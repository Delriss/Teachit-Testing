<?php 
//include the header
$activatedPage = "Home";
include($_SERVER['DOCUMENT_ROOT'] . '/content/partials/header.php');
?>

<body class="d-flex flex-column h-100">
    <!-- Main Content -->
    <div class="container-fluid text-center">
        <div class="row homeContainer mb-5">
            <div class="col-12 d-flex flex-column justify-content-center">
                <h1 class="display-1">Welcome to TeachIt Testing</h1>
                <p class="indexDescription fs-4 mt-5">TeachIt Testing is an online testing program which utilises reinforcement testing to help you learn in a fun and competitive manner!</p>
                <a class="text-black subtitle fs-4 text-decoration-underline mt-1" href="/register">Click here to get started today!</a>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="d-flex flex-column align-items-center justify-content-end">
                    <div class="indexScrollDown">
                        <p>Scroll Down</p>
                        <i class="fas fa-chevron-down fa-2x"></i>
                    </div>
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
                    <div class="col-12">
                        <p>All test results are tracked on the student dashboard. This will help students keep track of the subjects they need to work on!</p>
                        <img src="../public_static/imgs/screenshot1.png" alt="Progress" class="img-fluid" width="50%">
                    </div>
                </div>
            </div>

            <div class="col-sm-6 mb-5">
                <div class="homeFeature">
                    <h3>Support For Additional Subjects</h3>
                    <div class="col-12">
                        <p>Lecturers can add additional subjects to TeachIT Testing, as well as adding questions onto previous subjects. This will keep each topic up to date and allow students to further test their knowledge.</p>
                        <img src="../public_static/imgs/screenshot2.png" alt="Progress" class="img-fluid" width="50%">
                    </div>
                </div>
            </div>

            <div class="col-sm-6 mb-5">
                <div class="homeFeature">
                    <h3>Leaderboards For Each Subject</h3>
                    <div class="col-12">
                        <p>Each subject has a leaderboard which will show the top 5 students. Excel in your learning and aim for the top!</p>
                        <img src="../public_static/imgs/screenshot3.png" alt="Progress" class="img-fluid" width="50%">
                    </div>
                </div>
            </div>

            <div class="col-sm-6 mb-5">
                <div class="homeFeature">
                    <h3>Instant Results</h3>
                    <div class="col-12">
                        <p>You will recieve your test results as soon as you have finished the test, it does not require lecturers to mark it. You will be able to see which questions you got right or wrong to help you revise for that topic.</p>
                        <img src="../public_static/imgs/screenshot4.png" alt="Progress" class="img-fluid" width="65%">
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- End Main Content -->

<?php
//include the footer
include($_SERVER['DOCUMENT_ROOT'] . '/content/partials/footer.php');
?>

