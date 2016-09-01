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
?>