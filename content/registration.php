<?php
//include the header
$activatedPage = "Registration";
include($_SERVER['DOCUMENT_ROOT'] . '/content/partials/header.php');
?>

<body class="d-flex flex-column h-100">
    <!-- Main Content -->
    <div class="col-lg-6 mt-auto mx-auto p-3 py-md-3 text-center rounded bgColourFaded">
        <div class="text-center">
            <img src="../public_static/imgs/logo-transparent.png" alt="TeachIt Testing" width="150" height="150">
            <h1 class="display-5 fw-bold">TeachIt Registration</h1>
        </div>
        <form id="registrationForm">
            <input type="hidden" name="recapToken" id="recapToken">
            <div class="mb-2 d-flex">
                <input type="text" class="form-control m-1" id="studentNum" name="studentNum" placeholder="Student Number (Numbers Only)" required>
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

<?php
//include the footer
include($_SERVER['DOCUMENT_ROOT'] . '/content/partials/footer.php');
?>

