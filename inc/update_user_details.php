<?php

	session_start();
	require_once("../classes/init.php");
	$arr = array();

	if($_POST['war_status']!='') {
		$db 		= new Database();
		$war_status 	= $_POST['war_status'];
		$res 		= $db->updateContent(1, 'users', 'user_id', $_SESSION['user_id'], 'user_war_status', $war_status);
		if($res){
			array_push($arr, true);
		} else {
			array_push($arr, false);
		}
	} else {
		array_push($arr, false);
	}

	echo json_encode($arr);