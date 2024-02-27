<!DOCTYPE html>
<html class="h-100" lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="SEF">

    <title>Registration - TeachIt Testing</title>

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
        <div class="text-center">
            <img src="../content/imgs/logo-transparent.png" alt="TeachIt Testing" width="150" height="150">
            <h1 class="display-5 fw-bold">TeachIt Registration</h1>
        </div>
        <form id="registrationForm">
            <div class="mb-2 d-flex">
                <input type="text" class="form-control m-1" id="studentNum" name="studentNum" placeholder="Student Number" required>
                <input type="email" class="form-control m-1" id="email" name="email" placeholder="Email" required>
            </div>
            <div class="mb-2 d-flex">
                <input type="text" class="form-control m-1" id="firstName" name="firstName" placeholder="First Name" required>
                <input type="text" class="form-control m-1" id="lastName" name="lastName" placeholder="Last Name" required>
            </div>
            <div class="mb-2">
                <select class="form-select m-1" id="courseTitle" name="courseTitle" placeholder="Select Course" required>
                    <!-- <option value="1">Fill this with PHP/JS</option> -->
                </select>
            </div>
            <div class="mb-2">
                <input type="password" class="form-control m-1" id="password" name="password" placeholder="Password" required>
            </div>
            <div class="form-text">
                Password must be at least 8 characters long and contain at least one number and one special character.
            </div>
            <div class="mb-2">
                <input type="password" class="form-control m-1" id="confirmPassword" name="confirmPassword" placeholder="Confirm Password" required>
            </div>
            <button type="submit" class="btn btn-dark rounded-pill">Register</button>
            <hr>
            <p>Already have an account? <a id="loginText" href="/login">Login Here!</a></p>
        </form>
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