<?php
//check if there is user session
if (!isset($_SESSION['user'])){
    //if not, return to the login page
    header("Location: /login");
}
    
    if(isset($_POST["testID"]))
    {
        include_once($_SERVER['DOCUMENT_ROOT'].'/php/_connect.php'); 
        $testID = mysqli_real_escape_string($db_connect,$_POST["testID"]);

        $sql = "CALL deleteTest(?)";

        $stmt = $db_connect->prepare($sql); 
        $stmt->bind_param("i", $testID);
        $stmt->execute();
    }
    else
    {
        die("Error: Test ID not set");
    }
?>