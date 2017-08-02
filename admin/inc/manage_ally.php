<?php 
	require_once ("../../classes/init.php");

	$arr 		= array(); 

	if($_POST['ally_id']!='') {
		$ally_id 	= $_POST['ally_id'];
		$db 		= new Database();
		$res 		= $db->deleteContent('allies', 'ally_id', $ally_id);
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