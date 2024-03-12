<?php

//If not accessed via POST, refuse access - POST will only be via router/JS
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    //If the request is not a POST request, the user will be redirected to the login page
    header("Location: /");
    die();
}

//Connect to DB
include_once($_SERVER['DOCUMENT_ROOT'] . '/php/_connect.php');

//Retrieve all Students from database
$sql = "SELECT `ID`, `firstName`, `lastName`, `email`, `courseTitle`, `accountLock` FROM `users` WHERE 'acccessLevel' = 0";
$students = mysqli_query($db_connect, $sql);

//Output the students
echo ('
        <thead>
            <tr>
                <th>Student ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Course</th>
                <th>Locked</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
    ');

foreach ($students as $student) {
    echo ('
            <tr>
                <td>' . $student['ID'] . '</td>
                <td>' . $student['firstName'] . '</td>
                <td>' . $student['lastName'] . '</td>
                <td>' . $student['email'] . '</td>
                <td>' . $student['courseTitle'] . '</td>'
        . ($student['accountLock'] == 0 ? '<td>No</td>' : '<td>Yes</td>') .
        '<td>
                <button type="button" class="btn btn-primary">View</button>
                <button type="button" class="btn btn-danger">Delete</button>'
        . ($student['accountLock'] == 0 ? '<button type="button" class="btn btn-warning">Lock</button>' : '<button type="button" class="btn btn-success">Unlock</button>') .
        '</td>
            </tr>
        ');
}

echo ('</tbody>');
