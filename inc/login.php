<?php
	/* status
		0 -> successful
		1 -> not verified
		2 -> invalid credentials
	*/ 
	$arr 		= array();
	if(!empty($_POST)) {
		require_once "../classes/init.php";
		error_reporting(0);
		// Initialization for the encryption
		$method = base64_decode('QUVTLTEyOC1DQkM=');
		$pass = base64_decode('MTQoKWo1NzBhYm02bmMyM2RnaGkkJV4mKms4OWxvcHFyZUBmc3R1LV8rPS8qdnd4eXohIw==');
		$iv = openssl_random_pseudo_bytes(16);
		$enc 		= new Encrypt($method, $pass, $iv);

		// Creating the database object
		 $db 		= new Database();

		// Fetching the variables
		$username 	= $db::sanitize(trim($_POST['username']));
		$password 	= $enc::secureEncrypt(trim($_POST['password']));
		$remember 	= $db::sanitize(trim($_POST['rememberme']));

		// Checking for the user in the database
		$user 		= new Users();
		if($row 	= $user->loginUser($username, $password)){
			// Check if user has verified his/her email id
			$objsession 	= new Session();
			if(!empty($row['user_com_code'])){
				// User has not verified his/her email id
				$objsession->destroySession();
				array_push($arr, 1);
			} else {
				$objsession->setSession('user_id', $row['user_id']);
				if($remember==true){
					$encid 		= $enc::secureEncrypt($row['user_id']);
					setCookie('user_id', $encid, (time()+3600)*30, '/' );
				}
				array_push($arr, 0);
			}
		} else {
			array_push($arr, 2);
		}
	} else {
		header("Location:../");
	}
	echo json_encode($arr);