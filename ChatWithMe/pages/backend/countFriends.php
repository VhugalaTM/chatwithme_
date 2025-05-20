<?php 
    session_start();
    include 'dbConnection.php';

    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING ^ E_DEPRECATED);

    $userName=$_SESSION['myUsername'];

    $rows=$database->prepare("SELECT COUNT(*) FROM inbox WHERE username=:username");
    $rows->bindParam(":username", $userName);
    $rows->execute();
    $count=$rows->fetchColumn();
    
    if($count == 0){
        echo "$count friends added";
    }elseif($count == 1){
        echo "$count friend added";
    }elseif($count > 1){
        echo "$count friends added";
    }
?>