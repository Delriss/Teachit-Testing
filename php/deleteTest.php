<?php
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