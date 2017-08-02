<?php
	// error_reporting(0);
	require_once ("../../classes/init.php");
	// Add
	if($_POST['submit']==1){

		$file	= addslashes(file_get_contents($_FILES['addimg-file']['tmp_name']));
		$title	= Database::sanitize($_POST['imgtitle']);
		$alt	= Database::sanitize($_POST['imgalt']);
		$arr 	= array();

		if(!empty($file)&&!empty($title)&&!empty($alt)){
			$db = new Database();
			$res = $db->addContent(3, 'images', 'img_data', $file, 'img_title', $title, 'img_alt', $alt);
			if($res){
				array_push($arr, true);
			} else {
				array_push($arr, false);
			}
		} else {
			array_push($arr, false);
		}
	} 

	// Edit
	elseif ($_POST['submit'] == 2) {
		if(!empty($_FILES['modal-imgfile']['tmp_name'])){
			$file	= addslashes(file_get_contents($_FILES['modal-imgfile']['tmp_name']));
		}
		$arr 	= array();
		$title	= Database::sanitize($_POST['imgtitle']);
		$alt	= Database::sanitize($_POST['imgalt']);
		$id 	= Database::sanitize($_POST['imgid']);

		if(!empty($title)&&!empty($alt)&&!empty($id)){
			$db = new Database();
			if(!empty($file)){
				$res = $db->updateContent(3, 'images', 'img_id', $id, 'img_data', $file, 'img_title', $title, 'img_alt', $alt);
			} else {
				$res = $db->updateContent(2, 'images', 'img_id', $id, 'img_title', $title, 'img_alt', $alt);
			}
			if($res){
				array_push($arr, true);
			} else {
				array_push($arr, false);
			}
		} else {
			array_push($arr, false);
		}
	}
	// Delete
	elseif ($_POST['submit'] == 3) {
		$db = new Database();
		$id 	= Database::sanitize($_POST['imgid']);
		$arr 	= array();
		if(!empty($id)){
			$res	= $db->deleteContent('images', 'img_id', $id);
			if($res){
				array_push($arr, true);
			} else {
				array_push($arr, false);
			}
		} else {
			array_push($arr, false);
		}
	}

	echo json_encode($arr);