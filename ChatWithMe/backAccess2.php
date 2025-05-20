<?php 
    session_start();
    include 'dbConnection.php';
    
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING ^ E_DEPRECATED);


    //ACCESS THE VALUES FROM THE USER

    //REGISTRATION DATA
    if(isset($_POST['r-username']))
    $r_username=$_POST['r-username'];

    //VALIDATING LOGIN USERNAME
    $name=htmlentities(trim(strip_tags(filter_var($r_username, FILTER_SANITIZE_STRING))));
    
    if(isset($_POST['r-username-2']))
    $backup_username=$_POST['r-username-2'];

    if(isset($_POST['r-password']))
    $r_password=$_POST['r-password'];

    //REGISTRATION DETAILS

    //USER EXISTENCE
    $search=$database->prepare("SELECT * FROM user WHERE username=:username OR username_2=:username2 LIMIT 1");
    $search->bindParam(":username", $r_username);
    $search->bindParam(":username2", $backup_username);
    $search->execute();
    $user=$search->fetch();

    //ADDING DATA TO THE DATABASE
    $add=$database->prepare("INSERT INTO user (username, pass_word, username_2) VALUES (:username, :pass_word, :username_2)");
    $add->bindParam(":username", str_replace(' ','',$r_username));
    $add->bindParam(":pass_word", $r_password);
    $add->bindParam(":username_2", $backup_username);

    if((empty($r_username)) || (str_replace(" ","",$r_username)=="")){
        echo "* fill the login username entry";
    }elseif((empty($backup_username)) || (str_replace(" ", "",$backup_username)=="")){
        echo "* fill the backup username entry";
    }elseif((empty($r_password)) || (str_replace(" ", "",$r_password)=="")){
        echo "* fill the password entry";
    }elseif(!ctype_alnum($name)){
        echo "* invalid username, avoid entering spaces and symbols";
    }elseif(strlen($r_username)>15){
        echo "* username is too long";
    }elseif(strlen($backup_username)>50){
        echo "* backup username is too long";
    }elseif(strlen($r_password)>50){
        echo "* password is too long";
    }elseif($user){
        echo "* user already exist, make all the usernames unique";
    }elseif($r_username == $backup_username){
        echo "* login username is the same as the backup username, make the backup unique";
    }else{
        echo "registered successfully";
        $add->execute();
    }

?>