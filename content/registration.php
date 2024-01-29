<?php
// Start session
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" author="SEF">
    <title>Template - TeachIt Testing</title>

    <!-- Stylesheets -->
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <!-- End Stylesheets -->

</head>

<body>
    <header>
        <!-- Navigation -->
        <nav class="navbar navbar-expand-lg primaryBG">
            <div class="container-fluid text-white">
                <a href="index.php"><img src="imgs/logo-side.png" alt="TeachIt Logo" class="logo ps-5" width="350"></a>

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
        <main class="d-flex justify-content-center">
            <div class="container d-flex flex-column align-items-center justify-content-center pt-1 w-25">
                <div class="registrationContainer container-fluid">
                    <div class="regHeader subtitle text-center">
                        <img src="imgs/logo-transparent.png" alt="TeachIt Logo" class="logo" width="200">
                        <h3>Registration</h3>
                    </div>
                    <form action="registration.php" method="post">
                        <div class="mb-3">
                            <label for="studentNum" class="form-label">Student Number:</label>
                            <input type="text" name="studentNum" class="form-control" id="studentNum" aria-describedby="studentNumHelp">
                        </div>
                        <div class="mb-2">
                            <label for="firstName" class="form-label">First Name:</label>
                            <input type="text" name="firstName" class="form-control" id="firstName" aria-describedby="firstNameHelp">
                        </div>
                        <div class="mb-2">
                            <label for="lastName" class="form-label">Last Name:</label>
                            <input type="text" name="lastName" class="form-control" id="lastName" aria-describedby="lastNameHelp">
                        </div>
                        <div class="mb-2">
                            <label for="courseTitle" class="form-label">Course Title:</label>
                            <input type="text" name="courseTitle" class="form-control" id="courseTitle" aria-describedby="courseTitleHelp">
                        </div>
                        <div class="mb-2">
                            <label for="email" class="form-label">Email Address:</label>
                            <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-2">
                            <label for="password" class="form-label">Password:</label>
                            <input type="text" name="password" class="form-control" id="password" aria-describedby="passwordHelp">
                        </div>
                        <div class="mb-2">
                            <label for="passwordConfirm" class="form-label">Confirm Password:</label>
                            <input type="text" name="passwordConfirm" class="form-control" id="passwordConfirm" aria-describedby="passwordConfirmHelp">
                        </div>
                        <div class="buttonContainer d-flex justify-content-center">
                            <button type="submit" name="submit" class="btn btn-dark text-white">Submit</button>
                        </div>
                </div>
            </div>
        </main>
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
<!-- JS -->
<script src="js/scripts.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</html>