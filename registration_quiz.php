<?php 
	if(empty($_POST['language'])){
		header("Location:language_picker");
	} else {
		$language 	= $_POST['language'];
	}

	// Requiring the initialization file
	require_once ("classes/init.php");

	//Requiring the header file
	require_once ("lib/header.php");

	// Requiring the language selector
	require_once ("lib/registration_quiz_content.php");

?>
