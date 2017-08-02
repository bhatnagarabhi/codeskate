<?php	
	require_once ("../classes/init.php");
	$db 			= new Database();
	$language 		= $_POST['language'];
	$ques_id 		=  $_POST['ques_id'];
	$user_ans 		= trim(htmlspecialchars($_POST['user_ans']));
	$user_ans 		= str_replace(array("\r", "\n"), "", $user_ans);
	$query 			= "SELECT * FROM ques_{$language} left join ans_{$language} on ques_{$language}.ans_id = ans_{$language}.ans_id WHERE ques_id = {$ques_id}";
	$ques_join_ans_res 	= $db::executeQuery($query);
	$ques_join_ans_arr 	= mysqli_fetch_array($ques_join_ans_res);
	$ans 			= trim(htmlspecialchars($ques_join_ans_arr['ans']));
	$ans 			= str_replace(array("\r", "\n"), "", $ans);
	$arr 			= array();
	if(strcmp($ans, $user_ans)==0){
		array_push($arr, true);
	} else {
		array_push($arr, false);
	}
	echo json_encode($arr);
?>