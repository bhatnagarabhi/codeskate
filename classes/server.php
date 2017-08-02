<?php

	// This class contains details about the files on the server, directories, etc
	
	class Server
	{

		/* Used to pull out the list of all the php files in a directory*/
		function list_php_files($path){
			// to remove any (.) and (..) from the directory list
			$files = array_diff(scandir($path), array('.', '..'));
			return $files;
		}

		/* Used to pull out the list of all the files and folders in a directory*/
		function list_all_files($path) {
			$files = scandir($path);
			print_r($files);
		}

	}