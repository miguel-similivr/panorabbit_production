<?php

include_once '../../includes/functions.php';
include_once '../../includes/contentdb_connect.php';
include_once '../../includes/content-config.php';

sec_session_start();

$error_msg = "";

class contentobject {
	public $contentobjectuser;
	public $contentobjectid;
	public $contentobjecturl;
	public $contentobjecttitle;
	public $contentobjectdescription;
	public $contentobjectviews;
}

$iosarray = array();

if ($select_stmt = $contentmysqli->prepare("SELECT panorabbit_contenturl.id,panorabbit_contenturl.username,panorabbit_contenturl.thumbnail_url,panorabbit_contenturl.views,panorabbit_metadata.title,panorabbit_metadata.description 
	FROM `panorabbit_contenturl`
	LEFT JOIN `panorabbit_metadata` on panorabbit_contenturl.id = panorabbit_metadata.content_id")) {
	// Execute the prepared query.
	$select_stmt->execute();
	$select_stmt->bind_result($displayid, $displayuser, $displayurl, $displayviews, $displaytitle, $displaydescription);

	while ($select_stmt->fetch()) {
		$object = new contentobject;
		$object->contentobjectuser = $displayuser;
		$object->contentobjectid = $displayid;
		$object->contentobjecturl = $displayurl;
		$object->contentobjectviews = $displayviews;
		$object->contentobjecttitle = $displaytitle;
		$object->contentobjectdescription = $displaydescription;
		array_push($iosarray, $object);
	}

	echo json_encode($iosarray);
}


?>