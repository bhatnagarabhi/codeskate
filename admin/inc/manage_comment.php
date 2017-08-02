<?php 
	require_once ("../../classes/init.php");

	$arr 		= array(); 

	if($_POST['comment_id']!='') {
		$comment_id 	= $_POST['comment_id'];
		$db 		= new Database();
		$res 		= $db->deleteContent('answers', 'answer_id', $comment_id);
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