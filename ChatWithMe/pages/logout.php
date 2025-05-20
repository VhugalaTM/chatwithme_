<?php 
    session_start();
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING ^ E_DEPRECATED);
    include 'dbConnection.php';

    //UPDATING LOGIN STATUS
    $log_status=$database->prepare("UPDATE user SET login_status='offline' WHERE username=:username");
    $log_status->bindParam(":username", $_SESSION['myUsername']);
    $log_status->execute();

    unset($_SESSION['myUsername']);
    header("Location: ../access.php");
?>