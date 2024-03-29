<?php
include_once '../../includes/contentdb_connect.php';

$error_msg = "";

class contentobject {
	public $contentobjectuser;
	public $contentobjectid;
	public $contentobjecturl;
	public $contentobjecttitle;
	public $contentobjectdescription;
	public $contentobjectviews;
}

if ($_POST['scroll']) {
	unset($recentarray);
	$recentarray = array();
	mostRecent($contentmysqli, $recentarray, $_POST['scroll']);
	echo json_encode($recentarray);
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
	if ($select_stmt = $contentmysqli->prepare("SELECT panorabbit_contenturl.id,panorabbit_contenturl.username,panorabbit_contenturl.thumbnail_url,panorabbit_contenturl.views,panorabbit_metadata.title,panorabbit_metadata.description 
		FROM `panorabbit_contenturl`
		LEFT JOIN `panorabbit_metadata` on panorabbit_contenturl.id = panorabbit_metadata.content_id
		ORDER BY views DESC LIMIT 3")) {
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
		array_push($populararray, $object);
   }
	}
}

function mostRecent($contentmysqli, $recentarray, $start) {
	global $recentarray;
	if ($select_stmt = $contentmysqli->prepare("SELECT panorabbit_contenturl.id,panorabbit_contenturl.username,panorabbit_contenturl.thumbnail_url,panorabbit_contenturl.views,panorabbit_metadata.title,panorabbit_metadata.description 
		FROM `panorabbit_contenturl`
		LEFT JOIN `panorabbit_metadata` on panorabbit_contenturl.id = panorabbit_metadata.content_id
		ORDER BY created_datetime DESC LIMIT ?,9")) {
	// Execute the prepared query.
	$select_stmt->bind_param('i', $start);
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
		array_push($recentarray, $object);
   }
	}
}

function showRecommended($contentmysqli, $recommendedarray) {
	global $recommendedarray;

	if ($select_stmt = $contentmysqli->prepare("SELECT panorabbit_contenturl.id,panorabbit_contenturl.username,panorabbit_contenturl.thumbnail_url,panorabbit_contenturl.views,panorabbit_metadata.title,panorabbit_metadata.description 
		FROM `panorabbit_contenturl`
		LEFT JOIN `panorabbit_metadata` on panorabbit_contenturl.id = panorabbit_metadata.content_id
		ORDER BY RAND() DESC LIMIT 3")) {
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
		array_push($recommendedarray, $object);
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
	if ($select_stmt = $contentmysqli->prepare("SELECT panorabbit_contenturl.id,panorabbit_contenturl.username,panorabbit_contenturl.thumbnail_url,panorabbit_contenturl.views,panorabbit_metadata.title,panorabbit_metadata.description
		FROM `panorabbit_playlist_items`
		LEFT JOIN `panorabbit_contenturl` on panorabbit_playlist_items.content_id = panorabbit_contenturl.id
		LEFT JOIN `panorabbit_metadata` on panorabbit_playlist_items.content_id = panorabbit_metadata.content_id
		WHERE panorabbit_playlist_items.playlist_id = ?")) {
	$select_stmt->bind_param('i', $_GET['p']);
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
		array_push($playlistarray, $object);
   }
	}
}

function showExplore($contentmysqli, $explorearray) {
	global $explorearray;
	if ($select_stmt = $contentmysqli->prepare("SELECT panorabbit_contenturl.id,panorabbit_contenturl.username,panorabbit_contenturl.thumbnail_url,panorabbit_contenturl.views,panorabbit_metadata.title,panorabbit_metadata.description 
		FROM `panorabbit_contenturl`
		LEFT JOIN `panorabbit_metadata` on panorabbit_contenturl.id = panorabbit_metadata.content_id
		ORDER BY RAND() LIMIT 50")) {
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
		array_push($explorearray, $object);
   }
	}
}

function showDash($contentmysqli, $dashboardarray) {
	global $dashboardarray;
	if ($select_stmt = $contentmysqli->prepare("SELECT panorabbit_contenturl.id,panorabbit_contenturl.username,panorabbit_contenturl.thumbnail_url,panorabbit_contenturl.views,panorabbit_metadata.title,panorabbit_metadata.description 
		FROM `panorabbit_contenturl`
		LEFT JOIN `panorabbit_metadata` on panorabbit_contenturl.id = panorabbit_metadata.content_id
		WHERE panorabbit_contenturl.username = ?
		ORDER BY panorabbit_contenturl.created_datetime DESC")) {

	$select_stmt->bind_param('s', $_SESSION['username']);
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
		array_push($dashboardarray, $object);
   }
	}
}

function showFollowing($contentmysqli, $followingarray) {
	global $followingarray;
	if ($select_stmt = $contentmysqli->prepare("SELECT panorabbit_contenturl.id,panorabbit_contenturl.username,panorabbit_contenturl.thumbnail_url,panorabbit_contenturl.views,panorabbit_metadata.title,panorabbit_metadata.description 
		FROM `panorabbit_follow`
		INNER JOIN `panorabbit_users` on panorabbit_follow.following_id = panorabbit_users.id
		INNER JOIN `panorabbit_contenturl` on panorabbit_contenturl.username = panorabbit_users.username
		LEFT JOIN `panorabbit_metadata` on panorabbit_contenturl.id = panorabbit_metadata.content_id
		WHERE panorabbit_follow.follower_id = ?
		ORDER BY panorabbit_contenturl.created_datetime DESC")) {

	$select_stmt->bind_param('s', $_SESSION['user_id']);
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
		array_push($followingarray, $object);
   }
	}
}

?>
