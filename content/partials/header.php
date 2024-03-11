<!DOCTYPE html>
<html class="h-100" lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="SEF">

    <title><?php echo($activatedPage)?></title>

    <!-- Stylesheets -->
    <!-- linking css using routing wrapper -->
    <link rel="stylesheet" href="/public_static/css/style.css">
    <link rel="stylesheet" href="/public_static/css/testManagement.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
    <!-- End Stylesheets -->

        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-dark bgColour">
        <!-- Nav Container - adapt to screen size -->
        <div class="container-fluid">
            <a class="navbar-brand" href="/">
                <img src="/public_static/imgs/logo-side.png" alt="TeachIt Testing" width="200" height="50">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapsable" aria-controls="navbarCollapsable" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapsable">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                    <li class="nav-item">
                        <a class="nav-link<?php if($activatedPage == "Home"){echo(" active");}?>" aria-current="page" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link<?php if($activatedPage == "Test Selection"){echo(" active");}?>" href="/test-selection">Test Selection</a>
                    </li>
                    <li class="nav-item dropdown bgColour">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Lecturer Dashboard
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item<?php if($activatedPage == "Student Management"){echo(" active");}?>" href="/student-management">Student Management</a></li>
                            <li><a class="dropdown-item<?php if($activatedPage == "Test Management"){echo(" active");}?>" href="/test-management">Test Management</a></li>
                            <li><a class="dropdown-item<?php if($activatedPage == "Statistics"){echo(" active");}?>" href="/statistics">Statistics</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown bgColour">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Admin Dashboard
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item<?php if($activatedPage == "Lecturer Management"){echo(" active");}?>" href="/lecturer-management">Lecturer Management</a></li>
                        </ul>
                    </li>
            

                    <li class="nav-item">
                        <?php //if the session loggedin is set, show the logout button
                        if (isset($_SESSION['LoggedIn'])) {
                            echo '<a class="nav-link" href="/logout">Logout</a>';
                        } else {
                            echo '<a class="nav-link" href="/login">Login</a>';
                        }
                        ?>
                    </li>
                </ul>
            </div>
        </div>
        <!-- End Nav Container -->
    </nav>
    <!-- End Navbar -->
</head>

<?php

