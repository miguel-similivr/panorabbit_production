<?php
include_once '../../includes/db_connect.php';
include_once '../../includes/psl-config.php';
//include_once 'contentdb_connect.php';
 
$error_msg = "";
 
if (isset($_POST['p'], $_POST['resetkey'])) {
    if ($select_stmt = $mysqli->prepare("SELECT user_id FROM panorabbit_reset_code WHERE reset_key = ?")) {
    $select_stmt->bind_param('s', $_POST['resetkey']);
    // Execute the prepared query.
    $select_stmt->execute();
    $select_stmt->bind_result($id);
        while ($select_stmt->fetch()) {
        }
    }
    $password = filter_input(INPUT_POST, 'p', FILTER_SANITIZE_STRING);
    if (strlen($password) != 128) {
        // The hashed pwd should be 128 characters long.
        // If it's not, something really odd has happened
        $error_msg .= '<p class="error">Invalid password configuration.</p>';
    }

    // TODO: 
    // We'll also have to account for the situation where the user doesn't have
    // rights to do registration, by checking what type of user is attempting to
    // perform the operation.
 
    if (empty($error_msg)) {
 
        // Create hashed password using the password_hash function.
        // This function salts it with a random salt and can be verified with
        // the password_verify function.
        $password = password_hash($password, PASSWORD_BCRYPT);
 
        // Insert the new user into the database 
        if ($insert_stmt = $mysqli->prepare("UPDATE panorabbit_members SET password=? WHERE id=?")) {
            $insert_stmt->bind_param('ss', $password, $id);
            // Execute the prepared query.
            if (! $insert_stmt->execute()) {
                header('Location: ../error.php?err=Registration failure: INSERT');
            }
        }

        if ($delete_stmt = $mysqli->prepare("DELETE FROM panorabbit_reset_code WHERE reset_key=?")) {
            $delete_stmt->bind_param('s', $_POST['resetkey']);
            // Execute the prepared query.
            if (! $delete_stmt->execute()) {
                header('Location: ../error.php?err=Registration failure: INSERT');
            }
        }

        echo "it worked";
    }
} else {
    echo "stuff aint workin";
}

?>