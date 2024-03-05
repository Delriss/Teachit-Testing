<?php 
//include the header
$activatedPage = "Login";
include($_SERVER['DOCUMENT_ROOT'] . '/content/partials/header.php');
?>

<body class="d-flex flex-column h-100">
    <!-- Main Content -->
    <div class="col-lg-6 mt-auto mx-auto p-3 py-md-3 text-center rounded bgColourFaded">
        <div class="text-center">
            <img src="../content/imgs/logo-transparent.png" alt="TeachIt Testing" width="150" height="150">
            <h1 class="display-5 fw-bold">TeachIt Login</h1>
        </div>
        <form id="loginForm">
            <input type="hidden" name="recapToken" id="recapToken">
            <input type="email" class="form-control m-1" id="email" name="email" placeholder="Email" required>
            <input type="password" class="form-control m-1" id="password" name="password" placeholder="Password" required>
            
            <button type="submit" class="btn btn-dark rounded-pill">Login</button>
            <hr>
            <p>Don't have an account? <a id="loginText" href="/register">Register Here!</a></p>
        </form>
    </div>
    <!-- End Main Content -->

<?php
//include the footer
include($_SERVER['DOCUMENT_ROOT'] . '/content/partials/footer.php');
?>
