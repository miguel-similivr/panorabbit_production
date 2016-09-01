<?php
include_once '../includes/contentdb_connect.php';
include_once '../includes/content-config.php';
 
$error_msg = "";

$contentarray = array();

class contentobject {
	public $contentobjectuser;
	public $contentobjectid;
	public $contentobjecturl;
	public $contentobjecttitle;
	public $contentobjectdescription;
}

if ($select_stmt = $contentmysqli->prepare("SELECT id,username,url FROM panorabbit_contenturl ORDER BY created_datetime DESC LIMIT 9")) {
	// Execute the prepared query.
	$select_stmt->execute();
	$select_stmt->bind_result($displayid, $displayuser, $displayurl);

	while ($select_stmt->fetch()) {
		$object = new contentobject;
		$object->contentobjectuser = $displayuser;
		$object->contentobjectid = $displayid;
		$object->contentobjecturl = $displayurl;
		array_push($contentarray, $object);
   }
}

foreach ($contentarray as $value) {
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

?>
