<?php
	/* status
		0 -> successful
		1 -> not verified
		2 -> invalid credentials
	*/ 
	$arr 		= array();
	if(!empty($_POST)) {
		require_once "../../classes/init.php";
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

		session_start();

		// Verify the admin login
		$query 	= "SELECT * FROM admin WHERE admin_username='".$username."' AND admin_password='".$password."'";
		$res 		= $db::executeQuery($query);
		$num_rows	= mysqli_num_rows($res);
		if($num_rows>0) {
			$row 		= mysqli_fetch_array($res);
			$_SESSION['admin_id'] = $row['admin_id'];
			$time 		= time();
			$last_attempt 	= $db->fetchContentById(0, 'admin_id', $_SESSION['admin_id'], 'admin');
			$attempts_arr = mysqli_fetch_array($last_attempt);
			$attempts 	= $attempts_arr['admin_total_logins'];

			$res 		= $db->updateContent(2, 'admin', 'admin_id', $_SESSION['admin_id'], 'admin_last_login', $time, 'admin_total_logins', ++$attempts);

			array_push($arr, true);
		} else {
			array_push($arr, false);
		}
		
	} else {
		header("Location:../");
	}
	echo json_encode($arr);