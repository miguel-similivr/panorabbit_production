<?php
include_once '../../includes/db_connect.php';
include_once '../../includes/psl-config.php';

$error_msg = "";

$email = $_POST['email'];

function randomString($length){
  $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $charactersLength = strlen($characters);
  $randomString = '';
  for ($i = 0; $i < $length; $i++) {
      $randomString .= $characters[rand(0, $charactersLength - 1)];
  }
  return $randomString;
}

function insertCode($id, $resetkey, $mysqli) {
	if ($insert_stmt = $mysqli->prepare("INSERT INTO panorabbit_reset_code (user_id, reset_key, is_valid, created_datetime) VALUES (?, ?, 1, NOW())")) {
	  $insert_stmt->bind_param('ss', $id, $resetkey);
	  // Execute the prepared query.
	  if (! $insert_stmt->execute()) {
  		//error line here
      echo "wrong happened ";
		} else {
			echo "key has been inserted ";
		}
	}
}

function sendMail($resetkey, $email) {
	if(mail($email,"Panorabbit Password Reset","Hi there,\nClick this link to reset your password: https://panorabbit.com/register/reset_password.php?reset=".$resetkey))
		echo "Email successfully sent";
	else
		echo "An error occured";
}

if ($select_stmt = $mysqli->prepare("SELECT id FROM panorabbit_members WHERE email = ?")) {
	$select_stmt->bind_param('s', $email);
	// Execute the prepared query.
	$select_stmt->execute();
	$select_stmt->store_result();

	if ($select_stmt->num_rows > 0) {
		echo "this guy has an email ";
		$select_stmt->bind_result($id);
		$resetkey = randomString(8);
		while ($select_stmt->fetch()){
			echo $id;
			insertCode($id, $resetkey, $mysqli);
			sendMail($resetkey, $email);
			
		}
	} else {
		echo "no email ";
	}
}
?>