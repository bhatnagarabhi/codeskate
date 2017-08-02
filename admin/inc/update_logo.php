<?php
	error_reporting(0);
	if(isset($_POST['logo-submit'])){

		require_once ("../../classes/init.php");

		$file =  addslashes(file_get_contents($_FILES['logo']['tmp_name']));
		$arr = array();

		if(!empty($file)) {
			$db = new Database();
			$rs = $db->fetchAllContent(0, 'globals');
			// Check if the table has any rows or not
			if(mysqli_num_rows($rs)==1) {
				$res = $db->updateContent(1, 'globals' , 'global_id', 1, 'logo', $file);
				array_push($arr, true);
			} else {
				array_push($arr, false);
			}
		} else {
			array_push($arr, false);
		}

		echo json_encode($arr);

	}