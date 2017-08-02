
	<?php 
		session_start();

		if(isset($_SESSION['user_id'])) {
			header("Location: home.php");
		}
	?>
	
	<style type="text/css">
		body{
			background-image: url("images/background.png");
		}
	</style>

	<p>Hello</p>

<?php 
	// Requiring the initialization file
	require_once ("classes/init.php");

	//error_reporting(0);

	// Check for user cookies
	if($_COOKIE)
		$user_id 	= $_COOKIE['user_id'];

	
	$session 	= new Session();
	if($user_id!=''){
		$method = base64_decode('QUVTLTEyOC1DQkM=');
		$pass = base64_decode('MTQoKWo1NzBhYm02bmMyM2RnaGkkJV4mKms4OWxvcHFyZUBmc3R1LV8rPS8qdnd4eXohIw==');
		$iv = openssl_random_pseudo_bytes(16);

		$enc 		= new Encrypt($method, $pass, $iv);

		$session->setSession('user_id', $enc::secureDecrypt($user_id));
		header("Location:home");
	}

	//Requiring the header file
	require_once ("lib/header.php");

	// Requiring the modal 
	require_once("lib/home-login-status-modal.php");

	//Requiring the chooselogin section
	require_once ("lib/home-chooselogin.php");

	//Requiring the tiredofcompeting section
	require_once ("lib/home-tiredofcompeting.php");

	//Requiring warofcodes_title section
	require_once ("lib/home-warofcodes_title.php");

	//Requiring warofcodes section
	require_once ("lib/home-warofcodes.php");

	//Requiring formallies section
	require_once ("lib/home-formallies.php");

	//Requiring everythingabout section
	require_once ("lib/home-everythingabout.php");

	//Requiring editorfeatures section
	require_once ("lib/home-editorfeatures.php");

	//Requiring testimonials section
	require_once ("lib/home-testimonials.php");

	//Requiring the footer
	require_once ("lib/footer.php");

	//Requiring the signup modal
	require_once ("lib/modal-signup.php");