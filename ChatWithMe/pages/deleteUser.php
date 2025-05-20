<?php 
    session_start();
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING ^ E_DEPRECATED);
    include 'dbConnection.php';
    if(empty($_SESSION['myUsername'])){
        header("Location: ../access.php");
    }
    if(!empty($_SESSION['myUsername'])){
        $userName=$_SESSION['myUsername'];
    }

    //ACCESSING THE USERNAME FROM THE URL

    if(isset($_GET['username']))
    $user_id=$_GET['username'];
        
    $deleteUser=$database->prepare("DELETE FROM user WHERE username=:username");
    $deleteUser->bindParam(":username", $user_id);        
    $deleteUser->execute();

    $deleteInbox=$database->prepare("DELETE FROM inbox WHERE inbox_user=:username");
    $deleteInbox->bindParam(":username", $user_id);
    $deleteInbox->execute();

    $deleteMsg=$database->prepare("DELETE FROM messages WHERE  inbox_user=:username");
    $deleteMsg->bindParam(":username", $userName);
    $deleteMsg->execute();

    header("Location: ../access.php");
?>