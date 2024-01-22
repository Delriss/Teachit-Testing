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
    <!-- End Stylesheets -->

</head>

<body>
    <header>
        <!-- Navigation -->
        <nav class="navbar navbar-expand-lg primaryBG">
            <div class="container-fluid text-white">
                <img src="imgs/logo-side.png" alt="TeachIt Logo" class="logo ps-5" width="350">

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
    <main class="d-flex justify-content-center">
        <div class="container d-flex justify-content-center pt-2">
            <div class="row">
                <div class="col-12">
                    <h1>Main Content Area / Title</h1>
                    <p>Content Goes Here</p>
                </div>
            </div>
        </div>
    </main>
    <footer class="container-fluid primaryBG">
        <div class="container-fluid">
            TeachIt Testing
        </div>

    </footer>

</body>
<!-- JS -->
<script src="js/scripts.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</html>