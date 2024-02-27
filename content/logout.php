<?php

//Destroy Session and redirect to Home Page
session_start();
session_destroy();
header("Location: /");

?>