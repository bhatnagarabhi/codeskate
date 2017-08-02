<?php 
	$arr 	= array();
	if(!empty($_POST)){

		// Starting a session
		session_start();

		// Requiring the classes
		require_once "../classes/init.php";

		// Declaring allowed tags to be passed in thread content
		$allowedTags='<p><strong><em><u><h1><h2><h3><h4><h5><h6><img><span><script>';
		$allowedTags.='<li><ol><ul><span><div><br><ins><del>';

		$db 				= new Database();

		// Getting all the variables
		$thread_heading 		= addslashes($_POST['thread_heading']);
		$thread_language_id 		= $_POST['language_tag'];
		// $thread_content 		= addslashes(htmlspecialchars($_POST['thread_content']));
		$thread_content 		= addslashes($_POST['thread_content']);
		$user_id 			= $_SESSION['user_id'];
		$timestamp 			= time();

		// Execute the query
		$res 				= $db->addContent(5, 'threads', 'thread_heading', $thread_heading, 'thread_language_id', $thread_language_id, 'thread_content', $thread_content, 'user_id', $user_id, 'posted_at', $timestamp);

		if($res){
			// Query executed successfully
			$ob_user 	= new Users();
			// Increase UserXp
			if($ob_user->increaseUserXp($_SESSION['user_id'], 250)){
				$ob_user->pushNotification($_SESSION['user_id'], "You just posted a thread");
				array_push($arr, true);
			} else {
				array_push($arr, false);
			}
		} else {
			// There's some problem with the supplied data
			array_push($arr, false);
		}
	} else {
		array_push($arr, false);
	}
	echo json_encode($arr);
?>