<?php 
	
	class Session extends Encrypt
	{

		function __construct (){
			session_start();
		}

		public function setSession($var, $value){
			$_SESSION[''.$var]	= $value;
		}

		public function getSession($var){
			return $_SESSION[''.$var];
		}

		public function destroySession(){
			session_destroy();
		}

		public function unsetSession($id){
			unset($_SESSION[$id]);
		}

		public function initializeCookie($var, $value){
			$method = base64_decode('QUVTLTEyOC1DQkM=');
			$pass = base64_decode('MTQoKWo1NzBhYm02bmMyM2RnaGkkJV4mKms4OWxvcHFyZUBmc3R1LV8rPS8qdnd4eXohIw==');
			$iv = openssl_random_pseudo_bytes(16);

			$enc = new Encrypt($method, $pass, $iv);
			$value 		= $enc::secureEncrypt($value);
			
			setcookie(''+$var, ''+$value, (time()+3600)*30 ,'/');
		}

		public function getCookie($var){
			return $_COOKIE[$var];
		}

	}
?>