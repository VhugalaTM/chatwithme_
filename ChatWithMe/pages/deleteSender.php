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

    if(isset($_GET['delMessage']))
    $messageId=$_GET['delMessage'];

    $delete=$database->prepare("DELETE FROM messages WHERE message_id=:message_id");
    $delete->bindParam(":message_id", $messageId);
    $delete->execute();
    header("Location: chats.php?inboxUser=$_SESSION[receiver]");
?>
