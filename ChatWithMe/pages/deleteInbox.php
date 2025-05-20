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

    //ACCESSING THE INBOX_ID FROM THE URL

    if(isset($_GET['id'])){
        $inbox_id=$_GET['id'];
        
        $deleteInbox=$database->prepare("DELETE FROM inbox WHERE inbox_id=:inbox_id");
        $deleteInbox->bindParam(":inbox_id", $inbox_id);
        $deleteInbox->execute();
        header("Location: dashboard.php");
    }
?>