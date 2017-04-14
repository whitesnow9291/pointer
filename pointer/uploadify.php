<?php
/*
Uploadify v3.1.0
Copyright (c) 2012 Reactive Apps, Ronnie Garcia
Released under the MIT License <http://www.opensource.org/licenses/mit-license.php> 
*/
session_start();
// Define a destination
$targetFolder = '/uploaded_photos'; // Relative to the root
if (!empty($_FILES)) {
	$tempFile = $_FILES['Filedata']['tmp_name'];
	$targetPath = "../image/pointer". $targetFolder;
	$date = date("y-m-d-H-i-s");
	//$targetName=$_SESSION['user_name'].$date.$_FILES['Filedata']['name'];
	$targetName = $date. "." .  substr($_FILES['Filedata']['name'],strlen($_FILES['Filedata']['name'])-3,3);
	$targetFile = rtrim($targetPath,'/') . '/' .$targetName;
	
	// Validate the file type
	$fileTypes = array('jpg','jpeg','gif','png'); // File extensions
	$fileParts = pathinfo($_FILES['Filedata']['name']);
	
	if (in_array($fileParts['extension'],$fileTypes)) {
		move_uploaded_file($tempFile,$targetFile);
		echo json_encode($targetFile);
	} else {
		echo 'Invalid file type.';
	}
}
?>