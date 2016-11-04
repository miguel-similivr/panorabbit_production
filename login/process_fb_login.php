<?php
include_once '../../includes/db_connect.php';
include_once '../../includes/functions.php';
 
sec_session_start(); // Our custom secure way of starting a PHP session.
 
if (isset($_POST['fb_id'])) {
    $email = $_POST['email'];
    $fb_id = $_POST['fb_id']; // The hashed password.
 
    if (fb_login($email, $fb_id, $mysqli) == true) {
        // Login success
        echo 1;
    } else {
        // Login failed 
        echo 0;
    }
} else {
    // The correct POST variables were not sent to this page. 
    echo 2;
}
?>
