<?php
// Set activatedPage
$activatedPage = "Student Management";

// Include the header
include($_SERVER['DOCUMENT_ROOT'] . '/content/partials/header.php');
?>

<body class="d-flex flex-column h-100">

    <!-- Main Content -->
    <div class="container-fluid text-center">
        <div class="row">
            <div class="col-12">
                <h1 class="display-4 mt-5">Student Management</h1>
                <p class="lead">Please select a student to modify or create a student account</p>
                <button type="button" class="btn btn-primary" id="btnCreateStudent">Create Student</button>
                <button type="button" class="btn btn-secondary" id="btnResetPassword">Reset a Password</button>
            </div>
        </div>

        <hr class="my-4">

        <!--Implement DataTables-->
        <div class="container-fluid">
            <table id="studentTable" class="w-100 table table-striped table-hover">
                <!-- Fullfill with AJAX -->
            </table>
        </div>
    </div>

    <!-- End Main Content -->

    <?php
    //include the footer
    include($_SERVER['DOCUMENT_ROOT'] . '/content/partials/footer.php');
    ?>