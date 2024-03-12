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
                <p class="lead">Please select a test to take or create a test</p>
            </div>
        </div>

        <hr class="my-4">

        <!--Implement DataTables-->
        <div class="container-fluid">
            <table id="studentTable" class="w-100 table table-striped table-hover dataTable">
                <!-- Fullfill with AJAX -->
            </table>
        </div>
    </div>

    <!-- End Main Content -->

    <?php
    //include the footer
    include($_SERVER['DOCUMENT_ROOT'] . '/content/partials/footer.php');
    ?>