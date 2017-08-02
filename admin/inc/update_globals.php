<?php
	if(isset($_POST['submit'])){

		require_once ("../../classes/init.php");

		$sitename 		= $_POST['sitename'];
		$sitedesc 		= preg_replace("/<.*?>/", " ", $_POST['sitedesc']);
		$sitetitle		= $_POST['sitetitle'];
		$footertext		= $_POST['footertext'];
		$arr = array();

		if(!empty($sitename)&&!empty($sitedesc)&&!empty($sitetitle)&&!empty($footertext)) {
			$db = new Database();
			$rs = $db->fetchAllContent(0, 'globals');

			// Check if the table has any rows or not
			if(mysqli_num_rows($rs)==0) {
				// Since there are no rows, we need to perform insertion first
				$res = $db->addContent(4, 'globals', 'site_name', $sitename, 'site_description', $sitedesc, 'site_title', $sitetitle, 'footer_text', $footertext);
				array_push($arr, true);
			} else if(mysqli_num_rows($rs)==1){
				//Since there are already some rows, we need to perform updations
				$res = $db->updateContent(4, 'globals' , 'global_id', 1, 'site_name', $sitename, 'site_description', $sitedesc, 'site_title', $sitetitle, 'footer_text', $footertext);
				array_push($arr, true);
			} else {
				array_push($arr, false);
			}
		} else {
			array_push($arr, false);
		}
		echo json_encode($arr);
	}