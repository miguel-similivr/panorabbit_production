<?php
include_once '../../includes/contentdb_connect.php';
include_once '../../includes/content-config.php';
include_once '../../includes/functions.php';

sec_session_start();

$follower = $_SESSION['user_id'];
$following = $_POST['uploader_id'];

if ($select_stmt = $contentmysqli->prepare("SELECT follower_id FROM panorabbit_follow WHERE following_id = ? AND follower_id = ? LIMIT 1")) {
  $select_stmt->bind_param('ii', $following, $follower);
  $select_stmt->execute();
  $select_stmt->store_result();
  $select_stmt->bind_result($is_followed);
  $select_stmt->fetch();

  if ($select_stmt->num_rows == 1) {
  	if ($flw_stmt = $contentmysqli->prepare("DELETE FROM panorabbit_follow WHERE (follower_id = ? AND following_id = ?)")) {
		  $flw_stmt->bind_param('ii', $follower, $following);
		  // Execute the prepared query.
		  if (! $flw_stmt->execute()) {
	  		//error line here
	      header('Location: dashboard.php?error=301');
				exit;
			}
		}
  } else {
  	if ($flw_stmt = $contentmysqli->prepare("INSERT INTO panorabbit_follow (follower_id, following_id) VALUES (?, ?)")) {
		  $flw_stmt->bind_param('ii', $follower, $following);
		  // Execute the prepared query.
		  if (! $flw_stmt->execute()) {
	  		//error line here
	      header('Location: sxk.php');
				exit;
			}
		}
  }
}

?>