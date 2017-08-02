<?php 
	if(!empty($_POST)){
		
		require_once ('../classes/init.php');
		
		$arr 			= array();

		$db 			= new Database();
		$user_pic 		= addslashes(file_get_contents($_FILES['user_pic']['tmp_name']));
		$user_id 		= $_POST['user_id'];
		$res 			= $db->updateContent(1, 'users', 'user_id', $user_id, 'user_pic', $user_pic);
		if($res){
			array_push($arr, true);
		} else {
			array_push($arr, false);
		}
	} else {
		array_push($arr, false);
	}
	echo json_encode($arr);
?>