<?php
	if(isset($_POST['submit'])){

		require_once ("../../classes/init.php");

		$pagename 		= $_POST['pagename'];
		$filename		= $_POST['filename'];
		$submit		= $_POST['submit'];
		$page_id		= $_POST['pageid'];

		$arr = array();

		$db = new Database();

		/* $submit = 1 : 	Add a new page
		     $submit = 2 :	Edit a page
		     $submit = 3 : 	Delete a page
		*/
		if(!empty($pagename)&&!empty($filename)&&$submit==1) {
			//Performing insertion
			$res = $db->addContent(2, 'cms_pages', 'page_name', $pagename, 'page_href', $filename);
			if($res){
				array_push($arr, true);
			} else {
				array_push($arr, false);
			}
		} else if(!empty($pagename)&&!empty($filename)&&$submit==2){
			// Performing updation
			$res = $db->updateContent(2, 'cms_pages','page_id', $page_id , 'page_name', $pagename, 'page_href', $filename);
			if($res){
				array_push($arr, true);
			} else {
				array_push($arr, false);
			}
		} else if(!empty($page_id)&&$submit==3){
			// Performing deletion
			$res = $db->deleteContent( 'cms_pages', 'page_id', $page_id);
			if($res){
				array_push($arr, true);
			} else {
				array_push($arr, false);
			}
		} else {
			array_push($arr, false);
		}
		echo json_encode($arr);
	}