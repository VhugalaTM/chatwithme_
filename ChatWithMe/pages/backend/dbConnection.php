<?php 
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING ^ E_DEPRECATED);

    $database=new PDO('mysql:host=localhost; dbname=chatwithme','root');
?>