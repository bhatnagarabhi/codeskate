<?php
	session_start();
	require_once("../classes/init.php");
	$arr = array();

	if($_POST['req_id']!='') {
		$req_id 	= $_POST['req_id'];
		$user_id 	= $_SESSION['user_id'];
		$db 		= new Database();
		$query 	= "SELECT * FROM requests WHERE request_requester_id={$user_id} AND request_requestee_id={$req_id}";
		$res 		= $db::executeQuery($query);
		$is_sent	=  mysqli_num_rows($res);
		if($is_sent>0){
			// If the request is already sent
			array_push($arr, false);
		} else {
			// Fresh request to be sent
			$res 	= $db->addContent(3, 'requests', 'request_requester_id', $user_id, 'request_requestee_id', $req_id, 'request_is_approved', 0);
			if($res) {
				array_push($arr, true);
			} else {
				array_push($arr, false);
			}
		}
	} else {
		array_push($arr, false);
	}
	echo json_encode($arr);