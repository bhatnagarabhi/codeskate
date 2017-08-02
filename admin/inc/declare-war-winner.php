<?php 
	
	require_once ("../../classes/init.php");

	session_start();

	if($_SESSION['admin_id']=='')
		header("Location: ../");

	if(($_POST['war_id']=='') || ($_POST['entry_id']=='') ){
		header("Location: ../dashboard");
	} else {
		$db 		= new Database();
		$war_id 	= $_POST['war_id'];
		$entry_id 	= $_POST['entry_id'];
		$sql 		= "UPDATE wars SET war_winner_entry_id = {$entry_id} WHERE war_id={$war_id}";
		$res 		= $db::executeQuery($sql);
		if($res) {

			$sql = "SELECT * FROM wars WHERE war_id = {$war_id}";
			$res = $db::executeQuery($sql);
			$row = mysqli_fetch_array($res);
			$inc_factor = $row['war_win_xp'];
			$war_name = $row['war_question_heading'];

			$sql = "SELECT * FROM war_entries WHERE war_entry_id = {$entry_id}";
			$res = $db::executeQuery($sql);
			$row = mysqli_fetch_array($res);
			$user_id = $row['war_entry_user_id'];

			$sql = "SELECT * FROM users WHERE user_id = {$user_id}";
			$res = $db::executeQuery($sql);
			$row = mysqli_fetch_array($res);
			$ally_id = $row['user_ally_id'];
			$username = $row['user_username'];

			$sql 		= "SELECT * FROM users WHERE user_ally_id = {$ally_id}";
			$res = $db::executeQuery($sql);
			while($row = mysqli_fetch_array($res)) {
				$users = new Users();
				$users->increaseUserXp($row['user_id'], $inc_factor);
				$users->pushNotification($row['user_id'], "Your ally has been awarded {$inc_factor}XPs for winning the `{$war_name}` war. Entry by {$username}");
			}

			header("Location:../dashboard.php?msg=1");
		} else {
			header("Location:../dashboard.php?msg=2");
		}
	}
