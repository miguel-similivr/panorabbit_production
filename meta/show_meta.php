<?php
include_once '../includes/contentdb_connect.php';
include_once '../includes/content-config.php';
include_once '../includes/functions.php';

if ($select_stmt = $contentmysqli->prepare("SELECT title,description FROM panorabbit_metadata WHERE content_id = ? LIMIT 1")) {
	$select_stmt->bind_param('s', $_GET['id']);
	// Execute the prepared query.
	$select_stmt->execute();
	$select_stmt->bind_result($title, $description);

	while ($select_stmt->fetch()) {
   }
}

if ($inc_stmt = $contentmysqli->prepare("UPDATE panorabbit_contenturl SET views=views+1 WHERE id = ?")) {
	$inc_stmt->bind_param('s', $_GET['id']);
	// Execute the prepared query.
	$inc_stmt->execute();
}

if ($view_stmt = $contentmysqli->prepare("SELECT url,views FROM panorabbit_contenturl WHERE id = ? LIMIT 1")) {
	$view_stmt->bind_param('s', $_GET['id']);
	// Execute the prepared query.
	$view_stmt->execute();
	$view_stmt->bind_result($url, $views);

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
?>