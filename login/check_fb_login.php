<?php
include_once '../../includes/db_connect.php';
include_once '../../includes/functions.php';

class userobject {
	public $userobjectid;
	public $userobjectusername;
	public $userobjectemail;
	public $userobjectfb;
}

if ($_POST['fb_login']) {
	if ($stmt = $mysqli->prepare("SELECT id, username, email FROM panorabbit_members WHERE facebook_id = ? LIMIT 1")) {
		$stmt->bind_param('s', $_POST['fb_login']);  // Bind "$email" to parameter.
    $stmt->execute();    // Execute the prepared query.
    $stmt->store_result();

    // get variables from result.
    $stmt->bind_result($user_id, $username, $email);
    $stmt->fetch();

    if ($stmt->num_rows == 1) {
    	$object = new userobject;
			$object->userobjectid = $user_id;
			$object->userobjectusername = $username;
			$object->userobjectemail = $email;
			$object->userobjectfb = $_POST['fb_login'];
    	echo json_encode($object);
    } else {
    	echo 'Server Error';
    }
	}
	else {
		echo 'Server Error';
	}
}

?>