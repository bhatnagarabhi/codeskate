<?php 
	require_once ("../../classes/init.php");

	$arr 		= array(); 

	if($_POST['thread_id']!='') {
		$thread_id 	= $_POST['thread_id'];
		$db 		= new Database();
		$res 		= $db->deleteContent('threads', 'thread_id', $thread_id);
		if($res) {
			array_push($arr, true);
		} else {
			array_push($arr, false);
		}
	} else {
		array_push($arr, false);
	}
	echo json_encode($arr);
?>