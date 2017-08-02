<?php	
	require_once "../classes/init.php";

	/*  Mode ($mode) =======
		1. Insert
		2. Update
		3. Delete
	*/

	$arr = array();

	if(!empty($_POST['mode'])){

		session_start();

		// Instantiating database object
		$db 						 = new Database();
		$mode 						 = $_POST['mode'];
		$ally_name					 = $_POST['ally_name'];
		$ally_war_participation_freq = $_POST['ally_war_participation_frequency'];
		$ally_description			 = $_POST['ally_description'];
		$ally_leader_id 			 = $_SESSION['user_id'];

		if($mode==1){
			$ob_allies 		= new Allies();
			$ally_tag 		= $ob_allies->generateAllyTag();
			// Insertion
			$res 	= $db->addContent(5, 'allies', 'ally_name', $ally_name, 'ally_tag', $ally_tag , 'ally_war_participation_frequency', $ally_war_participation_freq, 'ally_description', $ally_description, 'ally_leader_id', $ally_leader_id);
			if($res){
				// User has to be the part of the ally too
				$res1			= $db->fetchContentById(0, 'ally_leader_id', $ally_leader_id, 'allies');
				$res1_arr 		= mysqli_fetch_array($res1);
				$added_ally_id	= $res1_arr['ally_id'];
				$is_user_upd 	= $db->updateContent(1, 'users', 'user_id', $ally_leader_id, 'user_ally_id', $added_ally_id);
				if($is_user_upd){
					$obuser		= new Users();
					$xp_inc		= 750;
					$obuser->increaseUserXp($ally_leader_id, $xp_inc);
					$obuser->pushNotification($ally_leader_id, "You just formed an ally named {$ally_name}, {$xp_inc} XPs awarded");
					array_push($arr, true);
				}
				else
					array_push($arr, false);
			} else {
				array_push($arr, false);
			}
		} else if($mode==2) {
			// Updation
		} else {
			// Deletion
		}

	} else {
		array_push($arr, false);
	}

	echo json_encode($arr);