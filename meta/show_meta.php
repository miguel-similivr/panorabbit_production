<?php
include_once '../includes/contentdb_connect.php';
include_once '../includes/content-config.php';
include_once '../includes/functions.php';

if ($select_stmt = $contentmysqli->prepare("SELECT title,description,meta_thumbnail_url FROM panorabbit_metadata WHERE content_id = ? LIMIT 1")) {
	$select_stmt->bind_param('s', $_GET['id']);
	// Execute the prepared query.
	$select_stmt->execute();
	$select_stmt->bind_result($title, $description, $url);

	while ($select_stmt->fetch()) {
   }
}

if ($inc_stmt = $contentmysqli->prepare("UPDATE panorabbit_contenturl SET views=views+1 WHERE id = ?")) {
	$inc_stmt->bind_param('s', $_GET['id']);
	// Execute the prepared query.
	$inc_stmt->execute();
}

if ($view_stmt = $contentmysqli->prepare("SELECT views FROM panorabbit_contenturl WHERE id = ? LIMIT 1")) {
	$view_stmt->bind_param('s', $_GET['id']);
	// Execute the prepared query.
	$view_stmt->execute();
	$view_stmt->bind_result($views);

	while ($view_stmt->fetch()) {
   }
}

if ($pl_stmt = $contentmysqli->prepare("SELECT title FROM panorabbit_playlists WHERE id = ? LIMIT 1")) {
	$pl_stmt->bind_param('i', $_GET['p']);
	// Execute the prepared query.
	$pl_stmt->execute();
	$pl_stmt->bind_result($pltitle);

	while ($pl_stmt->fetch()) {
   }
}

if ($like_stmt = $contentmysqli->prepare("SELECT COUNT(*) FROM panorabbit_likes WHERE content_id = ?")) {
	$like_stmt->bind_param('i', $_GET['id']);
	// Execute the prepared query.
	$like_stmt->execute();
	$like_stmt->bind_result($likes);

	while ($like_stmt->fetch()) {
   }
}

if ($isliked_stmt = $contentmysqli->prepare("SELECT user_id FROM panorabbit_likes WHERE (content_id = ? AND user_id = ?) LIMIT 1")) {
  $isliked_stmt->bind_param('ss', $_GET['id'], $_SESSION['user_id']);
  $isliked_stmt->execute();
  $isliked_stmt->store_result();
  $isliked_stmt->fetch();

  if ($isliked_stmt->num_rows == 1) {
  	$isliked = true;
  } else {
  	$isliked = false;
  }
}

if ($isflw_stmt = $contentmysqli->prepare("SELECT follower_id FROM panorabbit_follow WHERE (follower_id = ? AND following_un = ?) LIMIT 1")) {
  $isflw_stmt->bind_param('is', $_SESSION['user_id'], $_GET['user']);
  $isflw_stmt->execute();
  $isflw_stmt->store_result();
  $isflw_stmt->fetch();

  if ($isflw_stmt->num_rows == 1) {
  	$isfollowed = true;
  } else {
  	$isfollowed = false;
  }
}

if ($select_stmt = $contentmysqli->prepare("SELECT panorabbit_profilepic.profilepic_url
			FROM `panorabbit_contenturl`
			LEFT JOIN `panorabbit_users` on panorabbit_contenturl.username = panorabbit_users.username
			LEFT JOIN `panorabbit_profilepic` on panorabbit_users.id = panorabbit_profilepic.user_id
			WHERE panorabbit_contenturl.id = ?")) {
	$select_stmt->bind_param('s', $_GET['id']);
	// Execute the prepared query.
	$select_stmt->execute();
	$select_stmt->bind_result($profilepic);

	while ($select_stmt->fetch()) {
   }
  if (strlen($profilepic) == 0) {
		$profilepic = "/images/panorabbit_profile.png";
	}
  
}


?>