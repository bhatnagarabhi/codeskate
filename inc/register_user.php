<?php 
	error_reporting(0);
	if(!empty($_POST['submit'])){
		require_once("../classes/init.php");
		$db 	= new Database();

		// Initialization for the encryption
		$method = base64_decode('QUVTLTEyOC1DQkM=');
		$pass = base64_decode('MTQoKWo1NzBhYm02bmMyM2RnaGkkJV4mKms4OWxvcHFyZUBmc3R1LV8rPS8qdnd4eXohIw==');
		$iv = openssl_random_pseudo_bytes(16);
		$enc 		= new Encrypt($method, $pass, $iv);

		// Getting POST values
		$fname 	= $db::sanitize(trim($_POST['fullname']));
		$email 		= $db::sanitize(trim($_POST['email']));
		$username	= $db::sanitize(trim($_POST['username']));
		$encpassword 	= trim($enc::secureEncrypt($_POST['password']));
		$dob 		= $db::sanitize(trim($_POST['dob']));
		$com 		= $db->generateComCode();
		$timestamp 	= time();
		
		$user 		= new Users();

		// Inserting values into the database
		if(!$user->checkUsername($username)){
			header("Location:../register.php");
		}

		require_once("../sendmail.php");

	}
?>