<?php
include_once '../../includes/db_connect.php';
include_once '../../includes/functions.php';

if(isset($_POST["username"]))
{
    if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
        die();
    }
    
    $username = filter_var($_POST["username"], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH);
    
    $statement = $mysqli->prepare("SELECT username FROM panorabbit_members WHERE username=?");
    $statement->bind_param('s', $username);
    $statement->execute();
    $statement->bind_result($username);
    if($statement->fetch()){
        die('<span class="glyphicon glyphicon-remove">Username is NOT available</span>');
    }else{
        die('<span class="glyphicon glyphicon-ok">Username is available</span>');
    }
}
?>