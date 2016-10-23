<?php
include_once '../../includes/contentdb_connect.php';
include_once '../../includes/content-config.php';

class contentobject {
	public $contentobjectuser;
	public $contentobjectid;
	public $contentobjectpano;
	public $contentobjectthumb;
	public $contentobjecttitle;
	public $contentobjectdescription;
	public $contentobjectviews;
	public $contentobjectfbshare;
}

$iosarray = array();

if ($select_stmt = $contentmysqli->prepare("SELECT panorabbit_contenturl.id,panorabbit_contenturl.username,panorabbit_contenturl.url,panorabbit_contenturl.thumbnail_url,panorabbit_contenturl.views,panorabbit_metadata.title,panorabbit_metadata.description 
	FROM `panorabbit_contenturl`
	LEFT JOIN `panorabbit_metadata` on panorabbit_contenturl.id = panorabbit_metadata.content_id")) {
	// Execute the prepared query.
	$select_stmt->execute();
	$select_stmt->bind_result($displayid, $displayuser, $displaypano, $displaythumb, $displayviews, $displaytitle, $displaydescription);

	while ($select_stmt->fetch()) {
		$object = new contentobject;
		$object->contentobjectuser = $displayuser;
		$object->contentobjectid = $displayid;
		$object->contentobjectpano = $displaypano;
		$object->contentobjectthumb = $displaythumb;
		$object->contentobjectviews = $displayviews;
		$object->contentobjecttitle = $displaytitle;
		$object->contentobjectdescription = $displaydescription;
		$object->contentobjectfbshare = "https://www.facebook.com/sharer.php?u=http://panorabbit.com/view.php?id=".$displayid."%26user=".$displayuser;
		array_push($iosarray, $object);
	}

	echo json_encode($iosarray);
}


?>