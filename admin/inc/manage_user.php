<?php 
	require_once ("../../classes/init.php");

	$arr 		= array(); 

	if($_POST['user_id']!='') {
		$user_id 	= $_POST['user_id'];
		$db 		= new Database();
		/* Whenever a user is deleted -  
			1. Delete the comments
			2. Delete the threads
			3. Delete the notifications 
			4. Delete the requests
			5. Delete the user
			A trigger is used to facilitate the process
		*/
		$res 		= $db->deleteContent('users', 'user_id', $user_id);
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