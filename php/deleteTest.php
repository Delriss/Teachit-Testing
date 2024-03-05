<?php
    //ensure the user is logged in
    if (session_status() === PHP_SESSION_NONE) {
        //exit if the user is not logged in
        echo "Error: User not logged in";
        exit();
    }
    //exit if the user is not authorised
    if ($_SESSION["auth"] !== "authorisedUser") {
        echo "Error: User not authorised";
        exit();
    }

    if(isset($_POST["testID"]))
    {
        include_once($_SERVER['DOCUMENT_ROOT'].'/php/_connect.php'); 
        $testID = mysqli_real_escape_string($db_connect,$_POST["testID"]);

        $sql = "DELETE FROM tests WHERE testID = ?";

        $stmt = $db_connect->prepare($sql); 
        $stmt->bind_param("i", $testID);
        $stmt->execute();
    }
    else
    {
        die("Error: Test ID not set");
    }
?>