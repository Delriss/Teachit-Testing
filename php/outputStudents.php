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
$sql = "SELECT `ID`, `firstName`, `lastName`, `email`, `courseTitle`, `accountLock`, `lastLogin` FROM `users` WHERE `accessLevel` = 0";
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
                <th>Last Login</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
    ');

foreach ($students as $student) {
    //Get the course title
    $courseTitle = mysqli_query($db_connect, "SELECT `subjectName` FROM `subjects` WHERE `SID` = " . $student['courseTitle']);
    $courseTitle = mysqli_fetch_assoc($courseTitle);

    $student['courseTitle'] = $courseTitle['subjectName'];

    echo ('
            <tr>
                <td>' . $student['ID'] . '</td>
                <td>' . $student['firstName'] . '</td>
                <td>' . $student['lastName'] . '</td>
                <td>' . $student['email'] . '</td>
                <td>' . $student['courseTitle'] . '</td>'
                . ($student['accountLock'] == 0 ? '<td>No</td>' : '<td>Yes</td>') .
                '<td>'. $student['lastLogin'] .'</td>
                <td>
                    <button type="button" id="btnEdit" class="btn btn-primary mx-1" data-id="' . $student['ID'] . '">Edit</button>' .
                    '<button type="button" id="btnDelete" class="btn btn-danger mx-1" data-id="' . $student['ID'] . '">Delete</button>'
                    . ($student['accountLock'] == 0 ? '<button type="button" id="btnLock" class="btn btn-warning mx-1" data-id="' . $student['ID'] . '" data-lock="' . $student['accountLock'] . '">Lock</button>' : '<button type="button" id="btnUnlock" class="btn btn-success" data-id="' . $student['ID'] . '" data-lock="' . $student['accountLock'] . '">Unlock</button>') .
                '</td>
            </tr>
        ');
}

echo ('</tbody>');
