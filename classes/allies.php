<?php
	
	class Allies extends Database
	{

		
		public function getAllyDetails($id){
			$db 		= new Database();
			return $db->fetchContentById(0, 'ally_id', $id, 'allies');
		}

		public function increaseUserXp($user_id, $increment_factor){
			$db 			= new Database();
			$current_xp 		= $this->getUserXp($user_id);
			$inc_xp 		= $current_xp + $increment_factor;
			$res 			= $db->updateContent(1, 'users', 'user_id', $user_id, 'user_xp', $inc_xp);
			if($res){
				// Xp increased successfully
				return true;
			} else {
				// There was an error
				return false;
			}
		}

		public function pushNotification($user_id, $message) {
			$db 		= new Database();
			$time 		= time();
			$res 		= $db->addContent(3, 'notifications', 'user_id', $user_id, 'notification_content', $message, 'timestamp', $time);
			if($res){
				// Notification pushed successfully
				return true;
			} else {
				// Notification push failed
				return false;
			}
		}

		public function generateAllyTag(){
			$str 	= "5AD8FHJK3ZLMUGB97OEP4QR1IS0CTNV2WX6Y";
			$num 	= "";
			$tag 	= "#";
			for ($i=0; $i<=9 ; $i++) { 
				$index 	= rand(0,strlen($str));
				$tag 	= $tag.substr($str, $index, 1);
			}
			return $tag;
		}

	}
?>