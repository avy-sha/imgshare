<?php
//turn on php error reporting
session_start();
require_once('ImageManipulator.php');
error_reporting(E_ALL);
ini_set('display_errors', 1);
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "avy";
$conn = new mysqli($servername, $username, $password, $dbname);
$email=$_SESSION["username"];
$result = $conn->query("SELECT value FROM servervariables WHERE variable='cover'") ;
$row = $result->fetch_assoc();
$tobename=$row["value"];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	$name     = $_FILES['file']['name'];
	$tmpName  = $_FILES['file']['tmp_name'];
	$error    = $_FILES['file']['error'];
	$size     = $_FILES['file']['size'];
  $ext	  = strtolower(pathinfo($name, PATHINFO_EXTENSION));

	switch ($error) {
		case UPLOAD_ERR_OK:
			$valid = true;
			//validate file extensions
			if ( !in_array($ext, array('jpg','jpeg','png','gif')) ) {
				$valid = false;
				$response = 'Invalid file extension.';
			}
			//validate file size
			if ( $size/1024/1024 > 2 ) {
				$valid = false;
				$response = 'File size is exceeding maximum allowed size.';
			}
			//upload file
			if ($valid) {
				echo $tobename;
				echo $name;
				$ext = pathinfo($name, PATHINFO_EXTENSION);
				$targetPath =  dirname( __FILE__ ) . DIRECTORY_SEPARATOR. 'uploads' . DIRECTORY_SEPARATOR. 'cover'.$tobename.'.'.$ext;
				$manipulator = new ImageManipulator($tmpName);
				// resizing to 200x200
				$newImage = $manipulator->resample(900,400,false);
				// saving file to uploads folder
				$manipulator->save('../uploads/' .'cover'.$tobename.'.'.$ext);
				//move_uploaded_file($tmpName,$Path);
			//	move_uploaded_file($tmpName,$targetPath);
				$nextname='cover'.$tobename.'.'.$ext;
				$conn->query("UPDATE profile SET cover='$nextname' WHERE email='$email'");
				$next=$tobename+1;
				$conn->query("UPDATE servervariables SET value='$next' WHERE variable='cover'");
			  header( 'Location: project/server/profile.php' ) ;
				exit;
			}
			break;
		case UPLOAD_ERR_INI_SIZE:
			$response = 'The uploaded file exceeds the upload_max_filesize directive in php.ini.';
			break;
		case UPLOAD_ERR_PARTIAL:
			$response = 'The uploaded file was only partially uploaded.';
			break;
		case UPLOAD_ERR_NO_FILE:{
			$response = 'No file was uploaded.';
			header( 'Location: project/server/profile.php' ) ;
		 }
			break;
		case UPLOAD_ERR_NO_TMP_DIR:
			$response = 'Missing a temporary folder. Introduced in PHP 4.3.10 and PHP 5.0.3.';
			break;
		case UPLOAD_ERR_CANT_WRITE:
			$response = 'Failed to write file to disk. Introduced in PHP 5.1.0.';
			break;
		default:
			$response = 'Unknown error';
		break;
	}

	echo $response;
}
?>
