<?php
$activatedPage = "Test";
//include the header partial
include_once($_SERVER['DOCUMENT_ROOT'] . '/content/partials/header.php');
?>

<!DOCTYPE html>
<html class="h-100" lang="en">

<body class="d-flex flex-column h-100">
    <!-- Main Content -->
    <div class="col-lg-10 mt-auto mx-auto p-3 py-md-3 text-center rounded bgColourFaded" id="testingBackground">
        <div class="text-center" id="testingInterface">

            <!-- Code will be added here from a different php file through the script file -->

        </div>
    </div>
    <!-- End Main Content -->

<?php
//include the footer partial
include_once($_SERVER['DOCUMENT_ROOT'] . '/content/partials/footer.php');
?>