<?php
include_once '../../includes/contentdb_connect.php';
include_once '../../includes/content-config.php';
include_once '../../includes/functions.php';

require '../aws.phar';

use Aws\S3\S3Client;

sec_session_start();

$uploader = $_SESSION['username'];
$uploadOk = 1;
$input_error ="";

function randomString($length){
  $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $charactersLength = strlen($characters);
  $randomString = '';
  for ($i = 0; $i < $length; $i++) {
      $randomString .= $characters[rand(0, $charactersLength - 1)];
  }
  return $randomString;
}

$bucket = 'panorabbit001';

$target_dir = "/var/www/panorabbit.com/public_html/uploads/";
$file_basename = randomString(6) . "_" . basename($_FILES["fileToUpload"]["name"]);
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$target_thumb = $target_dir . "thumb_" . basename($_FILES["fileToUpload"]["name"]);
$temp_file = $_FILES["fileToUpload"]["tmp_name"];
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

list($upload_width, $upload_height) = getimagesize($temp_file);

if (isset($_POST["title"])) {
	$title = $_POST["title"];
} else {
	header("Location: dashboard.php?error=101");
  exit;
  $uploadOk = 0;
}

if (isset($_POST["description"])) {
	$description = $_POST["description"];
} else {
	header("Location: dashboard.php?error=101");
  exit;
  $uploadOk = 0;
}

if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        //"File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        //"File is not an image.";
        header("Location: dashboard.php?error=101");
        exit;
        $uploadOk = 0;

    }
}

if ($_FILES["fileToUpload"]["size"] > 10000000) {
    //File is too large;
    $uploadOk = 0;
    header("Location: dashboard.php?error=100");
    exit;
}

if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" && $imageFileType != "JPG" && $imageFileType != "JPEG") {
    //"Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
    header("Location: dashboard.php?error=101");
    exit;
} /*else {
		try {
			$ratio = $upload_width / $upload_height;
			if ($ratio != 2) {
		    //"Sorry, this is not an equirectangular image.";
		    $uploadOk = 0;
		    header("Location: dashboard.php?error=102");
		    exit;
			}
		} catch (Exception $e) {
			//"Sorry, this is not an equirectangular image.";
			$uploadOk = 0;
			header("Location: dashboard.php?error=102");
			exit;
		}
}*/

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    $upload_status = "Sorry, your file/url was not uploaded.";
// if everything is ok, try to upload file
} 
else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
  	$upload_status = "Your upload is processing now! Please wait while we do our magic.";

  	$imagick = new \Imagick(realpath($target_file));

  	//Image texture
  	$imagick->resizeImage(4096,2048,imagick::FILTER_LANCZOS, 1);

  	$imagick->writeImage($target_file);

		$s3Client = S3Client::factory(array(
		    'profile' => 'similivr001',
		    'region'  => 'us-west-2',
		    'version' => 'latest'
		));

		$result = $s3Client->putObject(array(
		    'Bucket'     => $bucket,
		    'Key'        => $uploader.'/'.$file_basename,
		    'SourceFile' => $target_file
		    )
		);

		$s3Client->waitUntil('ObjectExists', array(
		    'Bucket' => $bucket,
		    'Key'    => $uploader.'/'.$file_basename
		));

		//Thumbnail
		$imagick->resizeImage(348,174,imagick::FILTER_LANCZOS, 1);

  	$imagick->writeImage($target_thumb);

  	$result = $s3Client->putObject(array(
		    'Bucket'     => $bucket,
		    'Key'        => $uploader.'/thumb/'.$file_basename,
		    'SourceFile' => $target_thumb
		    )
		);

		$s3Client->waitUntil('ObjectExists', array(
		    'Bucket' => $bucket,
		    'Key'    => $uploader.'/thumb/'.$file_basename
		));

		$plainUrl = $s3Client->getObjectUrl($bucket, $uploader.'/'.$file_basename);
		$thumbUrl = $s3Client->getObjectUrl($bucket, $uploader.'/thumb/'.$file_basename);

		if ($insert_stmt = $contentmysqli->prepare("INSERT INTO panorabbit_contenturl (username, url, created_datetime, views, thumbnail_url) VALUES (?, ?, NOW(), 0, ?)")) {
		  $insert_stmt->bind_param('sss', $uploader, $plainUrl, $thumbUrl);
		  // Execute the prepared query.
		  if (! $insert_stmt->execute()) {
	  		//error line here
	      header('Location: dashboard.php?error=301');
				exit;
			}
			$content_id = $contentmysqli->insert_id;
			unlink($target_file);
			unlink($target_thumb);
		}

		if ($meta_stmt = $contentmysqli->prepare("INSERT INTO panorabbit_metadata (content_id, title, description) VALUES (?, ?, ?)")) {
			$meta_stmt->bind_param('sss', $content_id, $title, $description);
			if (! $meta_stmt->execute()) {
	  		//error line here
	      header('Location: dashboard.php?error=301');
				exit;
			}
		}
	}
}
header("Location: dashboard.php");
?>
