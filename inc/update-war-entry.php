<?php 
	
	session_start();

	require_once("../classes/init.php");

	$user_id = 0;

	if(($_SESSION['user_id']=='')||($_POST['war_id'])=='')
		header("Location:./");
	else 
		$user_id = $_SESSION['user_id'];

	if($_POST['code']!='' ) {
		$code 		= addslashes($_POST['code']);
		$war_id 	= $_POST['war_id'];

		$db 		= new Database();

		$res		= $db->addContent(3, 'war_entries', 'war_id', $war_id, 'war_entry_user_id', $user_id, 'war_entry_content', addslashes($code));

		if($res) {
			header("Location:../wars.php?msg=1");
		} else {
			header("Location:../wars.php?msg=2");
		}

	}