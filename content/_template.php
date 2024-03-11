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

    <?php
    //include the footer
    include($_SERVER['DOCUMENT_ROOT'] . '/content/partials/footer.php');
    ?>