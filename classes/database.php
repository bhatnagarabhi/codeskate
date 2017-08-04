	<?php

	class Database extends Encrypt
	{
		
		public $table;
		public static $mysqli;

		function __construct()
		{

			// Initialization for the encryption
			$method = base64_decode('QUVTLTEyOC1DQkM=');
			$pass = base64_decode('MTQoKWo1NzBhYm02bmMyM2RnaGkkJV4mKms4OWxvcHFyZUBmc3R1LV8rPS8qdnd4eXohIw==');
			$iv = openssl_random_pseudo_bytes(16);

			$enc = new Encrypt($method, $pass, $iv);
			// Declaring and defining the connection variables
			define (DB_HOST, $enc->secureDecrypt("Ui9jZkxWMUkzMzllbXFjMGNqTHhHQT09"));
			define (DB_USER, $enc->secureDecrypt("SHplUGVwUXVUUzM0eE8xbTVGSDQ4UT09"));
			define (DB_PASS, "");
			define (DB_NAME, $enc->secureDecrypt("Mk4xYWRXSUYyYnlMdWFXZnBBRTZVQT09"));

			// Connect to the database
			self::$mysqli = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME) or die ("Error: Could not establish a secure connection to the server!");

		}

		public static function sanitize($string){
			return filter_var($string, FILTER_SANITIZE_STRING);
		}

		public static function escape($string){
			return mysqli_real_escape_string(self::$mysqli, $string);
		}

		public static function executeQuery($query){
			self::sanitize($query);
			return mysqli_query(self::$mysqli, $query);
		}

		// Semi-overloaded function to fetch all the details out of a table using join (mode)
		// The modes are defined as -
		// 0. No Join
		// 1. Left Join
		// 2. Right Join
		public function fetchAllContent($mode, $table_left, $table_right=NULL, $left_col=NULL, $right_col=NULL){
			if($mode==0){
				$table = self::sanitize($table);
				$query = "SELECT * FROM {$table_left}";
			} else if ($mode==1){
				$table_left = self::sanitize($table_left);
				$table_right = self::sanitize($table_right);
				$left_col = self::sanitize($left_col);
				$right_col = self::sanitize($right_col);
				$query = "SELECT * FROM {$table_left} LEFT JOIN {$table_right} on {$table_left}.{$left_col} = {$table_right}.{$right_col}";
			}
			$res = self::executeQuery($query);
			return $res;
		}


		/* A custom function that fetches the content of a table, using it's specified primary key
		     The modes are defined as -
		     0. No join
		     1. Left join
		     2. Right join
		*/
		public function fetchContentById($mode, $col_name, $id, $table_left, $table_right=NULL, $left_col=NULL, $right_col=NULL){
			$table_left = self::sanitize($table_left);
			$col_name = self::sanitize($col_name);
			if($mode==0){
				$query = "SELECT * FROM {$table_left} WHERE {$col_name}='".$id."'";
			} else if($mode==1){
				$table_left 	= self::sanitize($table_left);
				$table_right 	= self::sanitize($table_right);
				$left_col	= self::sanitize($left_col);
				$right_col	= self::sanitize($right_col);
				$query 	= "SELECT * FROM {$table_left} l LEFT JOIN {$table_right} r ON l.{$left_col} = r.{$right_col} WHERE l.{$col_name}={$id}";
			}
			$res = self::executeQuery($query);
			return $res;
		}


		// Mode specifies the number of columns to be updated
		public function updateContent($mode, $table, $id_col_name,  $id, $field1, $val1, $field2=NULL, $val2=NULL, $field3=NULL, $val3=NULL, $field4=NULL, $val4=NULL, $field5=NULL, $val5=NULL, $field6=NULL, $val6=NULL, $field7=NULL, $val7=NULL, $field8=NULL, $val8=NULL, $field9=NULL, $val9=NULL, $field10=NULL, $val10=NULL){
			$table = self::sanitize($table);
			$field1 = self::sanitize($field1);
			$id_col_name = self::sanitize($id_col_name);
			if ($mode==1){
				$query = "UPDATE {$table} SET {$field1}='".$val1."' WHERE {$id_col_name}={$id}";
			} else if ($mode==2){
				$field2 = self::sanitize($field2);
				$val2 = self::sanitize($val2);
				$query = "UPDATE {$table} SET {$field1}='".$val1."', {$field2}='".$val2."' WHERE {$id_col_name}={$id}";
			} else if ($mode==3){
				$field2 = self::sanitize($field2);
				$val2 = self::sanitize($val2);
				$field3 = self::sanitize($field3);
				$val3 = self::sanitize($val3);
				$query = "UPDATE {$table} SET {$field1}='".$val1."', {$field2}='".$val2."', {$field3}='".$val3."' WHERE {$id_col_name}={$id}";
			} else if($mode==4) {
				$field2 = self::sanitize($field2);
				$val2 = self::sanitize($val2);
				$field3 = self::sanitize($field3);
				$val3 = self::sanitize($val3);
				$field4 = self::sanitize($field4);
				$val4 = self::sanitize($val4);
				$query = "UPDATE {$table} SET {$field1}='".$val1."', {$field2}='".$val2."', {$field3}='".$val3."', {$field4}='".$val4."' WHERE {$id_col_name}={$id}";
			} else if ($mode==5) {
				$field2 = self::sanitize($field2);
				$val2 = self::sanitize($val2);
				$field3 = self::sanitize($field3);
				$val3 = self::sanitize($val3);
				$field4 = self::sanitize($field4);
				$val4 = self::sanitize($val4);
				$field5 = self::sanitize($field5);
				$val5 = self::sanitize($val5);
				$query = "UPDATE {$table} SET {$field1}='".$val1."', {$field2}='".$val2."', {$field3}='".$val3."', {$field4}='".$val4."', {$field5}='".$val5."' WHERE {$id_col_name}={$id}";
			} else if($mode==6){
				$field2 = self::sanitize($field2);
				$val2 = self::sanitize($val2);
				$field3 = self::sanitize($field3);
				$val3 = self::sanitize($val3);
				$field4 = self::sanitize($field4);
				$val4 = self::sanitize($val4);
				$field5 = self::sanitize($field5);
				$val5 = self::sanitize($val5);
				$field6 = self::sanitize($field6);
				$val6 = self::sanitize($val6);
				$query = "UPDATE {$table} SET {$field1}='".$val1."', {$field2}='".$val2."', {$field3}='".$val3."', {$field4}='".$val4."', {$field5}='".$val5."', {$field6}='".$val6."' WHERE {$id_col_name}={$id}";
			} else if($mode==7){
				$query = "UPDATE {$table} SET {$field1}='".$val1."', {$field2}='".$val2."', {$field3}='".$val3."', {$field4}='".$val4."', {$field5}='".$val5."', {$field6}='".$val6."', {$field7}='".$val7."' WHERE {$id_col_name}={$id}";
			} else if($mode==8){
				$query = "UPDATE {$table} SET {$field1}='".$val1."', {$field2}='".$val2."', {$field3}='".$val3."', {$field4}='".$val4."', {$field5}='".$val5."', {$field6}='".$val6."', {$field7}='".$val7."', {$field8}='".$val8."' WHERE {$id_col_name}={$id}";
			}
			return self::executeQuery($query);
		}


		/*  Mode specifies how many arguments to take into consideration */
		public function addContent($mode, $table, $field1, $val1, $field2=NULL, $val2=NULL, $field3=NULL, $val3=NULL, $field4=NULL, $val4=NULL, $field5=NULL, $val5=NULL, $field6=NULL, $val6=NULL, $field7=NULL, $val7=NULL, $field8=NULL, $val8=NULL, $field9=NULL, $val9=NULL, $field10=NULL, $val10=NULL) {
			$table = self::sanitize($table);
			$field1 = self::sanitize($field1);
			if ($mode==1){
				$query = "INSERT INTO {$table} ({$field1}) VALUES ('".$val1."')";
			} else if ($mode==2){
				$query = "INSERT INTO {$table} ({$field1}, {$field2}) VALUES ('".$val1."', '".$val2."')";
			} else if ($mode==3){
				$query = "INSERT INTO {$table} ({$field1}, {$field2}, {$field3}) VALUES ('".$val1."', '".$val2."' , '".$val3."')";
			} else if($mode==4) {
				$query = "INSERT INTO {$table} ({$field1}, {$field2}, {$field3}, {$field4}) VALUES ('".$val1."', '".$val2."' , '".$val3."', '".$val4."')";
			} else if ($mode==5) {
				$query = "INSERT INTO {$table} ({$field1}, {$field2}, {$field3}, {$field4}, {$field5}) VALUES ('".$val1."', '".$val2."' , '".$val3."', '".$val4."' , '".$val5."')";
			} else if($mode==6){
				$query = "INSERT INTO {$table} ({$field1}, {$field2}, {$field3}, {$field4}, {$field5}, {$field6}) VALUES ('".$val1."', '".$val2."' , '".$val3."', '".$val4."' , '".$val5."', '".$val6."')";
			}else if($mode==7){
				$query = "INSERT INTO {$table} ({$field1}, {$field2}, {$field3}, {$field4}, {$field5}, {$field6}, {$field7}) VALUES ('".$val1."', '".$val2."' , '".$val3."', '".$val4."' , '".$val5."', '".$val6."', '".$val7."')";
			}
			return self::executeQuery($query);
		}

		public function deleteContent($table, $col_name, $id){
			$table = self::sanitize($table);
			$col_name = self::sanitize($col_name);
			$query = "DELETE FROM {$table} WHERE {$col_name} = {$id}";
			return self::executeQuery($query);
		}

		public function getRandom($table){
			$table = self::sanitize($table);
			$query = "SELECT * FROM {$table} ORDER BY rand() LIMIT 1";
			return self::executeQuery($query);
		}

		public function generateComCode(){
			$chars = "abcdefghijkmnopqrstuvwxyz023456789"; 
			    srand((double)microtime()*1000000); 
			    $i = 0; 
			    $pass = '' ; 

			    while ($i <= 100) { 
			        $num = rand() % 33; 
			        $tmp = substr($chars, $num, 1); 
			        $pass = $pass . $tmp; 
			        $i++; 
			    } 

			    return $pass; 
		}


		public static function html2text($html) {
		    $Rules = array ('@<script[^>]*?>.*?</script>@si',
		                    '@<[\/\!]*?[^<>]*?>@si',
		                    '@([\r\n])[\s]+@',
		                    '@&(quot|#34);@i',
		                    '@&(amp|#38);@i',
		                    '@&(lt|#60);@i',
		                    '@&(gt|#62);@i',
		                    '@&(nbsp|#160);@i',
		                    '@&(iexcl|#161);@i',
		                    '@&(cent|#162);@i',
		                    '@&(pound|#163);@i',
		                    '@&(copy|#169);@i',
		                    '@&(reg|#174);@i',
		                    '@&#(d+);@e'
		             );
		    $Replace = array ('',
		                      '',
		                      '',
		                      '',
		                      '&',
		                      '<',
		                      '>',
		                      ' ',
		                      chr(161),
		                      chr(162),
		                      chr(163),
		                      chr(169),
		                      chr(174),
		                      'chr()'
		                );
		    return preg_replace_callback($Rules, $Replace, $html);
		}
	}