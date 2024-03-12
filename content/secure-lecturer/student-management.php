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
            <table id="studentTable" class="w-100 display">
                <thead>
                    <tr>
                        <th>Student ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Course</th>
                        <th>Year</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Template row for DataTables -->
                    <tr>
                        <td>000000</td>
                        <td>John</td>
                        <td>Doe</td>
                        <td>Email</td>
                        <td>Course</td>
                        <td>Year</td>
                        <td>
                            <button type="button" class="btn btn-primary">View</button>
                            <button type="button" class="btn btn-danger">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- End Main Content -->

    <?php
    //include the footer
    include($_SERVER['DOCUMENT_ROOT'] . '/content/partials/footer.php');
    ?>