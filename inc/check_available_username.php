<?php
	$arr 		= array();
	if(!empty($_POST['username'])){
		$username 	= $_POST['username'];
		require_once("../classes/init.php");
		$user 		= new Users();
		if($user->checkUsername($username)){
			array_push($arr, true);
		} else {
			array_push($arr, false);
		}
	} else {
		array_push($arr, false);
	}
	echo json_encode($arr);
?>