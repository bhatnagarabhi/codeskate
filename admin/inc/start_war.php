<?php
	$arr = array();
	if($_POST['war_name']!=""){

		require_once ("../../classes/init.php");

		$war_xp 		= $_POST['war_xp'];
		$war_language_id	= $_POST['war_language_id'];
		$war_question 	= addslashes($_POST['war_question']);
		$war_question_content = addslashes($_POST['war_question_content']);
		$db 			= new Database();

		$res 			= $db->addContent(5, 'wars', 'war_language_id', $war_language_id, 'war_win_xp', $war_xp, 'war_question_heading', $war_question , 'war_winner_entry_id', 0, 'war_question_content', $war_question_content);
		if($res) {
			array_push($arr, true);
		} else {
			array_push($arr, false);
		}
	} else {
		array_push($arr, false);
	}
	echo json_encode($arr);