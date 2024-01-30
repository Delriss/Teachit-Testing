<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" author="SEF">
    <title>Test Management</title>

    <!-- Stylesheets -->
    <link rel="stylesheet" href="/content/css/style.css">
    <link rel="stylesheet" href="/content/css/testManagement.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
    <!-- End Stylesheets -->
</head>

<body>
    <header>
        <!-- Navigation -->
        <nav class="navbar navbar-expand-lg primaryBG">
            <div class="container-fluid text-white">
                <a href="index.php"><img src="/content/imgs/logo-side.png" alt="TeachIt Logo" class="logo ps-5" width="350"></a>

                <!-- Page Navigation -->
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <ul class="nav justify-content-end">
                                <li class="nav-item">
                                    <a class="nav-link text-white fs-4 subtitle active" href="index.php">Home</a>
                                </li>

                                <!-- Check if user is logged in -->
                                <?php if (isset($_SESSION)) : ?>
                                    <li class="nav-item">
                                        <a class="nav-link text-white subtitle fs-4" href="logout.php">Test Management</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-white subtitle fs-4" href="logout.php">Logout</a>
                                    </li>
                                <?php endif; ?>

                                <?php if (!isset($_SESSION)) : ?>
                                    <li class="nav-item">
                                        <a class="nav-link text-white subtitle fs-4" href="login.php">Login</a>
                                    </li>
                                <?php endif; ?>

                            </ul>
                        </div>
                    </div>
                </div>
                <!-- End Page Navigation -->

            </div>
        </nav>
        <!-- End Navigation -->
    </header>

    <!-- Main Content -->
    <div class="area">
        <div class="titleWrapper"><h3>Available Tests</h3></div>
            <div class="tableWrap tests-carousel" id="tests">
                <?php include_once($_SERVER['DOCUMENT_ROOT'].'/php/outputTests.php'); ?>
            </div>
        </div>
        </main>
        
        <!-- Modal -->
        <div class="container" style="max-width: 600px;">
            <form id="createTestModal">
                <div class="mb-3">
                    <label for="testName" class="form-label">Test Name</label>
                    <input type="text" class="form-control" id="testName">
                </div>
                <div class="mb-3">
                    <label for="testName" class="form-label">Question Name</label>
                    <input type="text" class="form-control answers" id="questionName">
                </div>
                <div class="mb-3">
                    <label for="answer1" class="form-label">Answer 1</label>
                    <input type="text" class="form-control answers" id="answer1">
                </div>
                <div class="mb-3">
                    <label for="answer2" class="form-label">Answer 2</label>
                    <input type="text" class="form-control answers" id="answer2">
                </div>
                <div class="mb-3">
                    <label for="answer3" class="form-label">Answer 3</label>
                    <input type="text" class="form-control answers" id="answer3">
                </div>
                <div class="mb-3">
                    <label for="answer4" class="form-label">Answer 4</label>
                    <input type="text" class="form-control answers" id="answer4">
                </div>

                <input class="form-check-input" type="radio" name="isCorrect" id="answerRadio1">
                <label class="form-check-label" for="answerRadio1 isCorrect">Answer 1</label>
                <input class="form-check-input" type="radio" name="isCorrect" id="answerRadio2">
                <label class="form-check-label" for="answerRadio2 isCorrect">Answer 2</label>
                <input class="form-check-input" type="radio" name="isCorrect" id="answerRadio3">
                <label class="form-check-label" for="answerRadio3 isCorrect">Answer 3</label>
                <input class="form-check-input" type="radio" name="isCorrect" id="answerRadio4">
                <label class="form-check-label" for="answerRadio4 isCorrect">Answer 4</label>

                <button type="submit" id="submitForm" class="btn btn-primary">Submit</button>
            </form>
        </div>

        <!-- End Main Content -->

        <footer class="container-fluid primaryBG w-100">
            <div class="footerContainer container-fluid d-flex justify-content-center align-items-center h-100 text-center subtitle text-white">
                <div class="container-fluid d-flex justify-content-evenly">
                    <span>TeachIt Testing &copy; 2021</span>
                    <a id="privPolicy" href="./">Privacy Policy</a>
                </div>
                <div class="container-fluid d-flex justify-content-evenly">
                    <a href="https://www.facebook.com/"><i class="fab fa-facebook-square fa-2x"></i></a>
                    <a href="https://www.instagram.com/"><i class="fab fa-instagram-square fa-2x"></i></a>
                    <a href="https://www.twitter.com/"><i class="fab fa-twitter-square fa-2x"></i></a>
                </div>
            </div>
        </footer>
    </div>

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
</html>
<!-- JS -->
<script src="/content/js/scripts.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
<script src="/content/js/test-management.js"></script>



