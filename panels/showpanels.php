<?php

$error_msg = "";

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
	if ($select_stmt = $contentmysqli->prepare("SELECT id,thumbnail_url,views FROM panorabbit_contenturl WHERE username = ? ORDER BY created_datetime DESC")) {
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

function showRecommended($contentmysqli, $recommendedarray) {
	global $recommendedarray;

	if ($select_stmt = $contentmysqli->prepare("SELECT id,username,thumbnail_url,views FROM panorabbit_contenturl ORDER BY RAND() LIMIT 3")) {
	// Execute the prepared query.
	$select_stmt->execute();
	$select_stmt->bind_result($displayid, $displayuser, $displayurl, $displayviews);

	while ($select_stmt->fetch()) {
		$object = new contentobject;
		$object->contentobjectuser = $displayuser;
		$object->contentobjectid = $displayid;
		$object->contentobjecturl = $displayurl;
		$object->contentobjectviews = $displayviews;
		array_push($recommendedarray, $object);
   }
	}

	foreach ($recommendedarray as $value) {
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

function showSearch($contentmysqli, $searcharray, $searchinput) {
	global $searcharray;

	$regexp = '';
	$temparray = array();

	foreach ($searchinput as $find) {
		$regexp = $regexp . $find . '|';
	}

	$regexp = substr($regexp,0,-1);

	if ($meta_stmt = $contentmysqli->prepare("SELECT content_id FROM panorabbit_metadata WHERE title REGEXP ?")) {
		$meta_stmt->bind_param('s', $regexp);
		$meta_stmt->execute();
		$meta_stmt->bind_result($temp);

		while ($meta_stmt->fetch()) {
			array_push($temparray, $temp);
		}
	}

	if ($select_stmt = $contentmysqli->prepare("SELECT id,username,thumbnail_url,views FROM panorabbit_contenturl WHERE id IN (".implode(',', $temparray).")")) {
		// Execute the prepared query.
		$select_stmt->execute();
		$select_stmt->bind_result($displayid, $displayuser, $displayurl, $displayviews);

		while ($select_stmt->fetch()) {
			$object = new contentobject;
			$object->contentobjectuser = $displayuser;
			$object->contentobjectid = $displayid;
			$object->contentobjecturl = $displayurl;
			$object->contentobjectviews = $displayviews;
			array_push($searcharray, $object);
	   }
	}

	foreach ($searcharray as $value) {
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

function showPlaylist($contentmysqli, $playlistarray) {
	global $playlistarray;
	$plitems = array();

	if ($select_stmt = $contentmysqli->prepare("SELECT content_id FROM panorabbit_playlist_items WHERE playlist_id = ?")) {
	$select_stmt->bind_param('i', $_GET['p']);
	// Execute the prepared query.
	$select_stmt->execute();
	$select_stmt->bind_result($plitemid);

	while ($select_stmt->fetch()) {
		array_push($plitems, $plitemid);
		}
	}

	foreach ($plitems as $item) {
		if ($select_stmt = $contentmysqli->prepare("SELECT username,thumbnail_url,views FROM panorabbit_contenturl WHERE id = ?")) {
		$select_stmt->bind_param('i', $item);
		// Execute the prepared query.
		$select_stmt->execute();
		$select_stmt->bind_result($displayuser, $displayurl, $displayviews);

		while ($select_stmt->fetch()) {
			$object = new contentobject;
			$object->contentobjectuser = $displayuser;
			$object->contentobjectid = $item;
			$object->contentobjecturl = $displayurl;
			$object->contentobjectviews = $displayviews;
			array_push($playlistarray, $object);
	   }
		}

		foreach ($playlistarray as $value) {
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
}

?>
