<?php
	
	require_once ("../../classes/init.php");

	$session 	= new Session();

	// If the user is logged in
	if($session->getSession('admin_id')){
		
		$admin_id 	= $session->getSession('admin_id');

		// Log the user out
		$session->unsetSession('admin_id');

		// Check and redirect the user
		if($session->getSession('admin_id')==''){
			echo "Logged out";
		} else {
			echo "Log out failed";
		}

	}

	header("Location:../index");