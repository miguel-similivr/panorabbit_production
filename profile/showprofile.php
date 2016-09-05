<?php
include_once '../../includes/contentdb_connect.php';
include_once '../../includes/content-config.php';
 
$error_msg = "";

$profilearray = array();

class contentobject {
	public $contentobjectuser;
	public $contentobjectid;
	public $contentobjecturl;
	public $contentobjecttitle;
	public $contentobjectdescription;
	public $contentobjectviews;
}

function showProfile($contentmysqli, $profilearray) {
	global $profilearray;
	if ($select_stmt = $contentmysqli->prepare("SELECT id,url,views FROM panorabbit_contenturl WHERE username = ? ORDER BY created_datetime DESC")) {
	$select_stmt->bind_param('s', $_GET['user']);
	// Execute the prepared query.
	$select_stmt->execute();
	$select_stmt->bind_result($displayid, $displayurl, $displayviews);

	while ($select_stmt->fetch()) {
		$object = new contentobject;
		$object->contentobjectuser = $_GET['user'];
		$object->contentobjectid = $displayid;
		$object->contentobjecturl = $displayurl;
		$object->contentobjectviews = $displayviews;
		array_push($profilearray, $object);
   }
	}

	foreach ($profilearray as $value) {
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
