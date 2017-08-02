<?php
	
	class Encrypt
	{

		public static $text, $method, $password, $ini_vector;

		function __construct($method, $password, $ini_vector){
			self::$method 		=   $method;
			self::$password 	=   $password;
			self::$ini_vector 	=   $ini_vector;
		}
		
		static function baseDecode($cipher){
			return base64_decode($cipher);
		}

		static function baseEncode($text){
			return base64_encode($text);
		}

		static function secureDecrypt($cipher) {
			$cipher = self::baseDecode($cipher);
			return openssl_decrypt($cipher, self::$method, self::$password); 
		}

		static function secureEncrypt($text){
			$text = openssl_encrypt($text, self::$method, self::$password);
			return self::baseEncode($text);
		}

	}