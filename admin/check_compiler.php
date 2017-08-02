<?php

	if(!empty($_POST['code'])) {
		$input = '10 8';
		$fields_string='';

		$code = $_POST['code'];
		$lang_id = $_POST['lang_id'];
		$url = 'http://api.hackerrank.com/checker/submission.xml';
		$key = 'hackerrank|1611022-978|e41817a5ae5b919b0aebb6dfb324c1ff93aa6b2e';
		$arr=array();

		//extract data from the post
		extract($_POST);

		// error_reporting(0);

		//set POST variables
		$url = 'http://api.hackerrank.com/checker/submission.json';
		$fields = array(
		'source' => urlencode($code),
		'testcases' => urlencode(json_encode(array($input))),
		'lang' => $lang_id,
		'api_key' => urlencode($key),
		'format' => "JSON"
		);

		//url-ify the data for the POST
		foreach($fields as $key=>$value)

		{ $fields_string .= $key.'='.$value.'&'; }
		rtrim($fields_string, '&');

		//open connection
		$ch = curl_init();

		//set the url, number of POST vars, POST data
		curl_setopt($ch,CURLOPT_URL, $url);
		curl_setopt($ch,CURLOPT_POST, count($fields));
		curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);

		//execute post
		$result = curl_exec($ch);
		
		//close connection
		curl_close($ch);

		
	} else {
		echo '<center><h2 class="theme-fg" style="margin-top:20px;">There seems to be an error</h2></center>';
	}
?>