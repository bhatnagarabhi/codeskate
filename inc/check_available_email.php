<?php
	$arr 		= array();
	if(!empty($_POST['email'])){
		$email 	= $_POST['email'];
		require_once("../classes/init.php");
		$user 		= new Users();
		if($user->checkEmail($email)){
			array_push($arr, true);
		} else {
			array_push($arr, false);
		}
	} else {
		array_push($arr, false);
	}
	echo json_encode($arr);
?>