<?php 
    session_start();
    include 'dbConnection.php';

    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING ^ E_DEPRECATED);


    $userName=$_SESSION['myUsername'];
    
    //SEARCHING 4 A FRIEND
    if(isset($_POST['friend']))
    $friend=$_POST['friend'];
    
    $searchFriend=$database->prepare("SELECT * FROM user WHERE username=:friendUsername");
    $searchFriend->bindParam(":friendUsername", $friend);
    $searchFriend->execute();
    $friendInfo=$searchFriend->fetch();

    //VALIDATING INBOX EXISTENCE
    $inboxValid=$database->prepare("SELECT * FROM inbox WHERE username=:username AND inbox_user=:inbox_user");
    $inboxValid->bindParam(":username", $userName);
    $inboxValid->bindParam(":inbox_user", $friend);
    $inboxValid->execute();
    $inbox=$inboxValid->fetch();

    $add_inbox=$database->prepare("INSERT INTO inbox (username, inbox_user) VALUES (:username, :inbox_user)");
    $add_inbox->bindParam(":username", $userName);
    $add_inbox->bindParam(":inbox_user", $friend);
    if(empty($friend)){
        echo "* enter your friend's username";
    }elseif(!$friendInfo){
        echo "* username doesn't exist";
    }elseif($friendInfo['username']!=$friend){
        echo "* invalid username";
    }elseif($inbox){
        echo "* friend has already been added";
    }elseif($friend == $userName){
        echo "* you can't add yourself";
    }else{
        $add_inbox->execute();
        $_SESSION['myFriend']=$friend;                
    }
    
?>