<?php	
	require_once "../classes/init.php";

	/*  Mode ($mode) =======
		1. Insert
		2. Update
		3. Delete
	*/

	if(!empty($_POST['mode'])){

		session_start();

		// Instantiating database object
		$db 			= new Database();

		$mode 			= $_POST['mode'];
		$timestamp 		= time();
		$user_id 		= $_SESSION['user_id'];
		$thread_id 		= $_POST['thread_id'];

		$arr 			= array();

		// Insert
		if($mode==1) {
			$ans_content 	= htmlspecialchars($_POST['ans_content']);
			$res 			= $db->addContent(4, 'answers', 'answer_content', $db::escape($ans_content), 'thread_id', $thread_id, 'user_id', $user_id, 'answered_at', $timestamp);
			$ob_user 		= new Users();
			if($res){
				$ob_user->increaseUserXp($_SESSION['user_id'], 100);
				array_push($arr, true);
			} else {
				array_push($arr, false);
			}
		} 

		// Update
		else if($mode==2) {

		}

		// Delete 
		else if($mode==3){

		} 

		else {

		}

		echo json_encode($arr);
	} 

?>