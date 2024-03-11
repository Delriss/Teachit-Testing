<?php
// Start session
session_start();

// Include the header
include($_SERVER['DOCUMENT_ROOT'] . '/content/partials/header.php');
?>

<body class="d-flex flex-column h-100">

    <!-- Main Content -->
    <div class="container-fluid text-center">
        CONTENT HERE!
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
<script src="../public_static/js/scripts.js"></script>

</html>