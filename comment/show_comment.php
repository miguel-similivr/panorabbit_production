<?php
include_once '../includes/contentdb_connect.php';
include_once '../includes/content-config.php';
include_once '../includes/functions.php';

//sec_session_start();

if ($select_stmt = $contentmysqli->prepare("SELECT commenter,comment_body,created_datetime FROM panorabbit_comments WHERE parent_id = ? ORDER BY created_datetime DESC")) {
	$select_stmt->bind_param('s', $_GET['id']);
	// Execute the prepared query.
	$select_stmt->execute();
	$select_stmt->bind_result($commenter, $comment_body, $created_datetime);

	while ($select_stmt->fetch()) {
		echo "<div class='comment'>";
			echo "<div class='col-xs-10 col-md-11'>";
				echo "<a>$commenter</a>";
				echo "<p>$comment_body</p>";
			echo "</div>";
		echo "</div>";
   }
}
?>