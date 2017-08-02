<?php
	
	class Posts extends Database
	{

		// Get all the threads started by a user
		public function getAllUserPosts($user_id){
			$db 		= new Database();
			$query		= "SELECT * FROM threads WHERE user_id={$user_id} ORDER BY posted_at DESC";
			$res 		= $db::executeQuery($query);
			return $res;
		}

		// Get a particular thread by a particular user
		public function getUserPostById($post_id){
			$db 		= new Database();
			$res 		= $db->fetchContentById(0, 'thread_id', $post_id, 'threads');
			return $res;
		}

		// Get all the posts by all the users
		public function getAllPosts($language=NULL){
			$db 		= new Database();
			if($language=='')
				$query 	= "SELECT * FROM threads ORDER BY thread_id DESC";
			else
				$query 	= "SELECT * FROM threads WHERE thread_language_id = {$language} ORDER BY thread_id DESC";
			$res 		= $db::executeQuery($query);
			return $res;
		}

		// Get the recent post by the user
		public function getRecentUserPost($user_id){
			$db 		= new Database();
			$query 	= "SELECT * FROM threads WHERE user_id={$user_id} ORDER BY thread_id DESC";
			$res 		= $db::executeQuery($query);
			return $res;
		}

		// Get all the comments posted by a user
		public function getAllUserComments($user_id){
			$db 		= new Database();
			$query		= "SELECT * FROM answers WHERE user_id={$user_id} ORDER BY answer_id DESC";
			$res 		= $db::executeQuery($query);
			return $res;
		}

		public function getAllThreadComments($thread_id){
			$db 		= new Database();
			$query 	= "SELECT * FROM answers WHERE thread_id={$thread_id}";
			$res 		= $db::executeQuery($query);
			return $res;
		}

		public function increaseViews($post_id){
			$db 		= new Database();
			$post_res 	= self::getUserPostById($post_id);
			$post_arr 	= mysqli_fetch_array($post_res);
			$views 	= $post_arr['thread_views'];
			$views++;
			$res 		= $db->updateContent(1, 'threads', 'thread_id', $post_id, 'thread_views', $views);
		}

	}
?>