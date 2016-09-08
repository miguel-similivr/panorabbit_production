<?php
include_once '../includes/contentdb_connect.php';
include_once '../includes/content-config.php';
 
$error_msg = "";

$populararray = array();
$recentarray = array();

class contentobject {
	public $contentobjectuser;
	public $contentobjectid;
	public $contentobjecturl;
	public $contentobjecttitle;
	public $contentobjectdescription;
	public $contentobjectviews;
}



function mostPopular($contentmysqli, $populararray) {
	global $populararray;
	if ($select_stmt = $contentmysqli->prepare("SELECT id,username,thumbnail_url,views FROM panorabbit_contenturl ORDER BY views DESC LIMIT 3")) {
	// Execute the prepared query.
	$select_stmt->execute();
	$select_stmt->bind_result($displayid, $displayuser, $displayurl, $displayviews);

	while ($select_stmt->fetch()) {
		$object = new contentobject;
		$object->contentobjectuser = $displayuser;
		$object->contentobjectid = $displayid;
		$object->contentobjecturl = $displayurl;
		$object->contentobjectviews = $displayviews;
		array_push($populararray, $object);
   }
	}

	foreach ($populararray as $value) {
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

function mostRecent($contentmysqli, $recentarray) {
	global $recentarray;
	if ($select_stmt = $contentmysqli->prepare("SELECT id,username,thumbnail_url,views FROM panorabbit_contenturl ORDER BY created_datetime DESC LIMIT 9")) {
	// Execute the prepared query.
	$select_stmt->execute();
	$select_stmt->bind_result($displayid, $displayuser, $displayurl, $displayviews);

	while ($select_stmt->fetch()) {
		$object = new contentobject;
		$object->contentobjectuser = $displayuser;
		$object->contentobjectid = $displayid;
		$object->contentobjecturl = $displayurl;
		$object->contentobjectviews = $displayviews;
		array_push($recentarray, $object);
   }
	}

	foreach ($recentarray as $value) {
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
