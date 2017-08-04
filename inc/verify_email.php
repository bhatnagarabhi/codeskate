<?php 
	require_once('../classes/init.php');
	$db 		= new Database();
	$com 		= $_REQUEST['com_code'];
	$users_res	= $db->fetchContentById(0, 'user_com_code', $com, 'users');
	$users_arr 	= mysqli_fetch_array($users_res);
	$user_id 	= $users_arr['user_id'];
	$baseurl	= $_SERVER['SERVER_NAME'];
	if(!empty($com)) {
		$res 	= $db->updateContent(1, 'users', 'user_id', $user_id, 'user_com_code', "");
		if($res){
			header("Location:http://{$baseurl}/codeskate/email_status?status=1");
		}else {
			echo "Invalid token";
		}
	} else {
		header("Location:http://{$baseurl}/codeskate/");
	}