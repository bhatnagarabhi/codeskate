<?php
	
	require_once ("../classes/init.php");

	$session 	= new Session();

	// If the user is logged in
	if($session->getSession('user_id')){
		
		$id 	= $session->getSession('user_id');

		// Log the user out
		$session->unsetSession('user_id');

		// Clear any saved cookie
		setcookie('user_id', '', (time()-3600)*(-390), '/');

		// Check and redirect the user
		if($session->getSession('user_id')==''){
			echo "Logged out";
		} else {
			echo "Log out failed";
		}

	}

	header("Location:../");