<?php 
	
	require_once("../classes/init.php");

	$arr 		= array();

	if(!empty($_POST['clear'])) {

		$mode 		= $_POST['clear'];
		$db 		= new Database();

		if($mode=='all'){
			
			// Mark all notifications as read
			
			$query 	= "UPDATE notifications set is_read=1";
			$res 		= $db::executeQuery($query);
			if($res){
				array_push($arr, true);
			} else {
				array_push($arr, false);
			}
		} else {
			// Mark this notification as read
			$res 		= $db->updateContent(1, 'notifications', 'notification_id', $mode, 'is_read', 1);
			if($res){
				array_push($arr, true);
			} else {
				array_push($arr, false);
			}
		}
	} else {
		array_push($arr, false);
	}

	echo json_encode($arr);

?>