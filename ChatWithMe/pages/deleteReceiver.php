<?php 
    session_start();
    include 'dbConnection.php';
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING ^ E_DEPRECATED);
    if(empty($_SESSION['myUsername'])){
        header("Location: ../access.php");
    }
    if(!empty($_SESSION['myUsername'])){
        $userName=$_SESSION['myUsername'];
    }

    if(isset($_GET['delReceiver']))
    $msgId=$_GET['delReceiver'];

    $delete=$database->prepare("DELETE FROM messages WHERE message_id=:message_id");
    $delete->bindParam(":message_id", $msgId);
    $delete->execute();
    header("Location: chats.php?inboxUser=$_SESSION[receiver]");
?>
