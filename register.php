<?php 
	if(empty($_POST['isevaluated'])){
		header("Location:language_picker");
	}

	// Requiring the initialization file
	require_once ("classes/init.php");

	//Requiring the header file
	require_once ("lib/header.php");

	// Requiring the modals
	require_once("lib/register-modal.php");

	// Requiring the registration form
	require_once('lib/register-form.php');

?>