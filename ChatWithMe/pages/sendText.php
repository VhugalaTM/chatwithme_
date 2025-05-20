<?php 
    session_start();
    include 'dbConnection.php';
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING ^ E_DEPRECATED);
    
    if(!empty($_SESSION['myUsername'])){
        $userName=$_SESSION['myUsername'];
    }

    $inboxUser=$_SESSION['receiver'];


    //ACCESSING THE TEXT FROM THE USER
    if(isset($_POST['message']))
    $message=$_POST['message'];

    $sendText=$database->prepare("INSERT INTO messages (username, inbox_user, message_content) VALUES (:username, :inbox_user, :message_content)");
    $sendText->bindParam(":username", $userName);
    $sendText->bindParam(":inbox_user", $inboxUser);
    $sendText->bindParam(":message_content", $message);
    if((empty($message)) || !(str_replace(' ','',$message))){
        echo "* text something";
    }else{
        $sendText->execute();   
    }
?>