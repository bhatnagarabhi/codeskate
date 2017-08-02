<?php
	
	class Users extends Database
	{

		public function checkUsername($username){
			$res 	= parent::fetchContentById(0, 'user_username', $username, 'users');
			$row 	= mysqli_num_rows($res);
			if($row>0){
				return false;
			} else {
				return true;
			}
		}

		public function checkEmail($email){
			$res 	= parent::fetchContentById(0, 'user_email', $email, 'users');
			$row 	= mysqli_num_rows($res);
			if($row>0){
				return false;
			} else {
				return true;
			}
		}

		public function loginUser($username, $password){
			// The password must be encrypted beforehand
			$db 		= new Database();
			$query 	= "SELECT * FROM users WHERE user_username = '".$username."' AND user_pass = '".$password."'";
			$res 		= $db::executeQuery($query);
			$row 		= mysqli_fetch_array($res);
			return $row;
		}

		public function getUserDetails($id){
			$db 		= new Database();
			return $db->fetchContentById(0, 'user_id', $id, 'users');
		}

		public function getUserLevel($xp){
			$lower_lim 	= 0;
			$upper_lim 	= 100;
			for($lvl=2; ; $lvl++){
				if(($xp<=100) && ($xp>=0)){
					return 1;
				} else if(($xp<=$upper_lim) && ($xp>=$lower_lim)){
					// This is the user level !
					return $lvl-1;
				} else {
					$lower_lim 	= $upper_lim;
					$upper_lim 	= $upper_lim * 2;
				}
			}
		}

		public function getRemainingXp($xp){
			$lvl 			= $this->getUserLevel($xp);
			$upper_lim 		= pow(2, $lvl-1)*100;
			$remaining_xp 	= $upper_lim - $xp;
			return $remaining_xp;
		}

		public function getXpPercent($xp){
			$lvl 			= $this->getUserLevel($xp);
			$lower_lim 		= pow(2, $lvl-2)*100;
			$upper_lim 		= pow(2, $lvl-1)*100;
			$lower_xp 		= ($xp-$lower_lim);
			$rem_xp_per 		= ($lower_xp/($upper_lim-$lower_lim))*100;
			return $rem_xp_per;
		}

		public function getUserXp($user_id){
			$user_details 		= $this->getUserDetails($user_id);
			$user_arr 		= mysqli_fetch_array($user_details);
			return $user_arr['user_xp'];
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

	}
?>