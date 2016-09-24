<?php
include_once '../../includes/contentdb_connect.php';
include_once '../../includes/content-config.php';
include_once '../../includes/functions.php';

sec_session_start();

$liker = $_SESSION['user_id'];
$parent_id = $_POST['parentid'];
$increment = $_POST['increment'];

if ($select_stmt = $contentmysqli->prepare("SELECT user_id FROM panorabbit_likes WHERE (content_id = ? AND user_id = ?) LIMIT 1")) {
  $select_stmt->bind_param('ss', $parent_id, $liker);
  $select_stmt->execute();
  $select_stmt->store_result();
  $select_stmt->bind_result($is_liked);
  $select_stmt->fetch();

  if ($select_stmt->num_rows == 1) {
  	if ($like_stmt = $contentmysqli->prepare("DELETE FROM panorabbit_likes WHERE (content_id = ? AND user_id = ?)")) {
		  $like_stmt->bind_param('ss', $parent_id, $liker);
		  // Execute the prepared query.
		  if (! $like_stmt->execute()) {
	  		//error line here
	      header('Location: dashboard.php?error=301');
				exit;
			}
			header("Location: ".$_SERVER['HTTP_REFERER']);
		}
  } else {
  	if ($like_stmt = $contentmysqli->prepare("INSERT INTO panorabbit_likes (content_id, user_id) VALUES (?, ?)")) {
		  $like_stmt->bind_param('ss', $parent_id, $liker);
		  // Execute the prepared query.
		  if (! $like_stmt->execute()) {
	  		//error line here
	      header('Location: dashboard.php?error=301');
				exit;
			}
			header("Location: ".$_SERVER['HTTP_REFERER']);
		}
  }
}

?>