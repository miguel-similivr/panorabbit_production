<?php
if ($select_stmt = $contentmysqli->prepare("SELECT profilepic_url FROM panorabbit_profilepic WHERE user_id = ? LIMIT 1")) {
	$select_stmt->bind_param('s', $_SESSION['user_id']);
	// Execute the prepared query.
	$select_stmt->execute();
	$select_stmt->bind_result($profilepicurl);

	while ($select_stmt->fetch()) {
   }
}

if (strlen($profilepicurl) == 0) {
	$profilepicurl = "/images/panorabbit_profile.png";
}
?>