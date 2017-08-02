<?php
	require_once ("../../classes/init.php");

	if(!empty($_POST)){
		$linkid	= $_POST['linkid'];
		if(!empty($linkid)){
			$db = new Database();
			$res = $db->deleteContent('navbar_links', 'link_id', $linkid);
			$arr = array();
			if($res){
				array_push($arr, true);
			} else {
				array_push($arr, false);
			}
		}
		echo json_encode($arr);
	}
?>