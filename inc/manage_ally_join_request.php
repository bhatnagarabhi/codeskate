<?php	
	require_once "../classes/init.php";

	/*  Mode ($mode) =======
		1. Allow
		2. Deny
	*/

	$arr = array();

	if(!empty($_POST['requester_id'])){

		session_start();

		// Instantiating database object
		$db 					= new Database();
		$users 					= new Users();
		$requester_id 				= $_POST['requester_id'];
		$mode 				= $_POST['mode'];
		$ally_id				= $_POST['ally_id'];
		$leader_id 				= $_SESSION['user_id'];

		if($mode==1){
			// Request accepted (update the users table with the ally id)
			$db 			= new Database();
			$res 			= $db->updateContent(1, 'users', 'user_id', $requester_id, 'user_ally_id', $ally_id);
			if($res) {
				$query 	= "SELECT * FROM requests WHERE request_requester_id={$requester_id} AND request_requestee_id={$leader_id}";
				$res 		= $db::executeQuery($query);
				$row		= mysqli_fetch_array($res);
				$request_id 	= $row['request_id'];
				$res 		= $db->deleteContent('requests', 'request_id', $request_id);
				if($res){
					$name_res 		= $db->fetchContentById(0, 'ally_id', $ally_id, 'allies');
					$ally_name_arr	= mysqli_fetch_array($name_res);
					$ally_name 		= $ally_name_arr['ally_name'];
					$users->pushNotification($requester_id, "Your request for joining {$ally_name} ally, has been approved.");
					array_push($arr, true);
				} else {
					array_push($arr, false);
				}
			} else {
				array_push($arr, false);
			}
		} else {
			$db 		= new Database();
			$query 	= "SELECT * FROM requests WHERE request_requester_id={$requester_id} AND request_requestee_id={$leader_id}";
			$res 		= $db::executeQuery($query);
			$row		= mysqli_fetch_array($res);
			$request_id 	= $row['request_id'];
			$res 		= $db->deleteContent('requests', 'request_id', $request_id);
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