<?php 
    session_start();
    include 'dbConnection.php';

    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING ^ E_DEPRECATED);


    //UPDATING DATA
    if(isset($_POST['u_username']))
    $u_username=$_POST['u_username'];

    if(isset($_POST['u_password']))
    $u_password=$_POST['u_password'];

    //VALIDATING USER EXISTENCE
    $backup_search=$database->prepare("SELECT * FROM user WHERE username_2=:username_2");
    $backup_search->bindParam(":username_2", $u_username);
    $backup_search->execute();
    $output=$backup_search->fetch();

    //UPDATING EXISTING DATA
    $update=$database->prepare("UPDATE user set pass_word=:pass_word WHERE username_2=:username_2");
    $update->bindParam(":username_2", $u_username);
    $update->bindParam(":pass_word", $u_password);

    if(empty($u_username)){
        echo "* fill all the blanks";
    }elseif((empty($u_password)) || (str_replace(" ","",$u_password)=="")){
        echo "* fill all the blanks";
    }elseif(strlen($u_password)>50){
        echo "* password is too long";
    }elseif(!$output){
        echo "* backup username doesn't exist";
    }elseif($output['username_2']!=$u_username){
        echo "* invalid backup username";
    }else{
        echo "password updated";
        $update->execute();
    }
?>