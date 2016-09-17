<?php
$error_msg = "";

$dashboardarray = array();

class contentobject {
	public $contentobjectuser;
	public $contentobjectid;
	public $contentobjecturl;
	public $contentobjecttitle;
	public $contentobjectdescription;
	public $contentobjectviews;
}

function showDash($contentmysqli, $dashboardarray) {
	global $dashboardarray;
	if ($select_stmt = $contentmysqli->prepare("SELECT id,thumbnail_url,views FROM panorabbit_contenturl WHERE username = ? ORDER BY created_datetime DESC")) {
	$select_stmt->bind_param('s', $_SESSION['username']);
	// Execute the prepared query.
	$select_stmt->execute();
	$select_stmt->bind_result($displayid, $displayurl, $displayviews);

	while ($select_stmt->fetch()) {
		$object = new contentobject;
		$object->contentobjectuser = $_SESSION['username'];
		$object->contentobjectid = $displayid;
		$object->contentobjecturl = $displayurl;
		$object->contentobjectviews = $displayviews;
		array_push($dashboardarray, $object);
   }
	}

	foreach ($dashboardarray as $value) {
		if ($meta_stmt = $contentmysqli->prepare("SELECT title,description FROM panorabbit_metadata WHERE content_id = ? LIMIT 1")) {
			$meta_stmt->bind_param('i', $value->contentobjectid);
			$meta_stmt->execute();
			$meta_stmt->bind_result($displaytitle, $displaydescription);

			while ($meta_stmt->fetch()) {
				$value->contentobjecttitle = $displaytitle;
				$value->contentobjectdescription = $displaydescription;
			}
		}
	}
}
?>
