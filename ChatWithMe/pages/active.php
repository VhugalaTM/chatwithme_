<?php
    session_start();
    include 'dbConnection.php';
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING ^ E_DEPRECATED);

    if(!empty($_SESSION['myUsername'])){
        $userName=$_SESSION['myUsername'];
    }
    $inboxUser=$_SESSION['receiver'];

    $login=$database->prepare("SELECT * FROM user WHERE username=:username");
    $login->bindParam(":username", $inboxUser);
    $login->execute();
    $login_status=$login->fetch();    

    if($login_status==""){
        //header("Location: dashboard.php");
        echo "<script>
            setInterval(()=>{
                window.location.reload()
            },1000)
        </script>";
    }else{
        echo $login_status['login_status'];
    }
?>