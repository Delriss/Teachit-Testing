<?php http_response_code(404); ?>

<!DOCTYPE html>
<html>

<head>
    <title>404 Not Found</title>
    <style>
        body {
            background-color: #eeeeee;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-family: "Segoe UI", "Helvetica Neue", "Helvetica", "Arial", sans-serif;
        }

        .error-box {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 90%;
        }

        h1 {
            margin-top: 0;
            color: #b35a46;
        }

        @media (prefers-color-scheme: dark) {
            body {
                background-color: #222222;
            }

            .error-box {
                background-color: #333333;
                color: white;
            }

            h1 {
                color: #ff8a80;
            }
        }
    </style>
</head>

<body>
    <div class="error-box">
        <h1>404 Not Found</h1>
        <p>The requested URL was not found on this server.</p>
        <code><?= htmlspecialchars($_GET['error_uri']) ?></code>
    </div>
</body>

</html>