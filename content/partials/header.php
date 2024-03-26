<?php
//FIX this is hacky, should be done with autoloading or using extends I think
require_once("php/userClass.php");

//retrieve object from session to get the user's access level
if (isset($_SESSION['user'])) {
    $user = unserialize($_SESSION['user']);
    $accessLevel = intval($user->accessLevel);
}
?>

<!DOCTYPE html>
<html class="h-100" lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="SEF">

    <title><?php echo($activatedPage)?></title>

    <!-- Stylesheets -->
    <link rel="shortcut icon" href="/public_static/imgs/favicon.ico" type="image/x-icon">

    <!-- linking css using routing wrapper -->
    <link rel="stylesheet" href="/public_static/css/style.css">
    <link rel="stylesheet" href="/public_static/css/testManagement.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.2/css/dataTables.dataTables.css" />
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
                    <?php 
                    //if user is logged in show the test selection link
                    if (isset($_SESSION['user'])) {
                        if($activatedPage == "Test Selection"){
                            echo(
                            <<<HERE
                            <li class="nav-item">
                                <a class="nav-link active" href="/test-selection">Test Selection</a>
                            </li>
                            HERE
                            );
                        }
                        else{
                            echo(
                            <<<HERE
                            <li class="nav-item">
                                <a class="nav-link" href="/test-selection">Test Selection</a>
                            </li>
                            HERE
                            );
                        }
                    }
                    if (isset($_SESSION['user'])) {
                        if($activatedPage == "Leaderboard"){
                            echo(
                            <<<HERE
                            <li class="nav-item">
                                <a class="nav-link active" href="/leaderboard">Leaderboard</a>
                            </li>
                            HERE
                            );
                        }
                        else{
                            echo(
                            <<<HERE
                            <li class="nav-item">
                                <a class="nav-link" href="/leaderboard">Leaderboard</a>
                            </li>
                            HERE
                            );
                        }
                    }
                    //if the session role is lecturer, show the lecturer dashboard link
                    if (isset($_SESSION['user']) && $accessLevel == 1) {
                        if($activatedPage == "Statistics" || $activatedPage == "Student Management" || $activatedPage == "Test Management"){
                            $lecturerActive = " active";
                        }
                        else{
                            $lecturerActive = "";
                        }
                        echo(
                        <<<HERE
                        <li class="nav-item dropdown bgColour">
                            <a class="nav-link dropdown-toggle$lecturerActive" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Lecturer Dashboard
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="/student-management">Student Management</a></li>
                                <li><a class="dropdown-item" href="/test-management">Test Management</a></li>
                                <li><a class="dropdown-item" href="/statistics">Statistics</a></li>
                            </ul>
                        </li>
                        HERE
                        );
                    }
                    //if the session role is admin, show the admin dashboard link, FIX THIS WHEN AUTH IS USING A CLASS OBJECT WITH AN ARRAY OF ROLES AS AN ATTRIBUTE
                    else if (isset($_SESSION['user']) && $accessLevel == 2) {
                        if($activatedPage == "Statistics" || $activatedPage == "Student Management" || $activatedPage == "Test Management" || $activatedPage == "Lecturer Management"){
                            $adminActive = " active";
                        }
                        else{
                            $adminActive = "";
                        }
                        echo(
                        <<<HEREDOC
                        <li class="nav-item dropdown bgColour">
                            <a class="nav-link dropdown-toggle$adminActive" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Admin Dashboard
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="/student-management">Student Management</a></li>
                                <li><a class="dropdown-item" href="/test-management">Test Management</a></li>
                                <li><a class="dropdown-item" href="/statistics">Statistics</a></li>
                                <li><a class="dropdown-item" href="/lecturer-management">Lecturer Management</a></li>
                            </ul>
                        </li>
                        HEREDOC
                        );
                    }
                    ?>

                    <li class="nav-item">
                        <?php //if the session loggedin is set, show the logout button
                        if (isset($_SESSION['LoggedIn'])) {
                            echo '<button class="nav-link btnLogout">Logout</button>';
                        } else {
                            //if current page is login, make login active
                            if($activatedPage == "Login"){
                                echo '<a class="nav-link active" href="/login">Login</a>';
                            }
                            else{
                                echo '<a class="nav-link" href="/login">Login</a>';
                            }
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


