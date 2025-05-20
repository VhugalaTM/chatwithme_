<?php 
    session_start();
    include 'dbConnection.php';

    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING ^ E_DEPRECATED);

    //ACCESS THE VALUES FROM THE USER

    //LOGIN DATA
    if(isset($_POST['username']))
    $username=$_POST['username'];

    if(isset($_POST['password']))
    $password=$_POST['password'];

    //VALIDATING USER EXISTENCE
    //Login details
    $search=$database->prepare("SELECT * FROM user WHERE username=:username");
    $search->bindParam(":username", $username);
    $search->execute();
    $user=$search->fetch();

    //          DECRYPTING THE DATA


    if(empty($username)){
        echo "* fill all the blanks";
    }elseif(empty($password)){
        echo "* fill all the blanks";
    }elseif(!$user){
        echo "* user doesn't exist";
    }elseif($user['username']!=$username){
        echo "* invalid username";
    }elseif($user['pass_word']!=$password){
        echo "* invalid password";
    }else{
        $_SESSION['myUsername']=$username;

        //CHANGING USER LOGIN STATUS
        $login=$database->prepare("UPDATE user SET login_status='online' WHERE username=:username");
        $login->bindParam(":username", $username);
        $login->execute();

        $log=$user['login_status'];
        $_SESSION['myStatus']=$log;
        echo "logged";
    }


?>