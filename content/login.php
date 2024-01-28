<?php include_once($_SERVER['DOCUMENT_ROOT'].'/php/_connect.php'); ?>

<!-- This is just the form for the login page, functionality and then style is next. -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" author="SEF">
    <title>Template - TeachIt Testing</title>

    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <form method="POST" action="_auth.php">
        <h1>Login</h1>

        <label for="username">Username:</label>
        <input id="username" name="username" type="text" placeholder="Username" required>

        <label for="password">Password:</label>
        <input id="password" name="password" type="password" placeholder="Password" required>

        <button type="Submit">
            <span>Login</span>
        </button>
    </form>
</body>

</html>