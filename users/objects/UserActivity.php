<?php 
class UserActivity {
	
	public static function latestActivityTime($db,$userID) {
			try {
		$query = $db->query("SELECT `time` FROM `usera_ctivity` WHERE `userid` = '{$userID}' ORDER BY `time` DESC LIMIT 1");
			} catch (PDOException $e){ die($e->getMessage()); }
		$row = $query->fetch(PDO::FETCH_ASSOC);
		return $row['time'];
	}
	
	
	
	public static function recordActivity($db,$userID,$page) {
		//get present time
		$time = date('Y-m-d H:i:s',time());
		/*//record only if greater than 10 seconds
		//get latest time stored for this user
		$latestActivityTime = self::latestActivityTime($db,$userID);
		$diff = strtotime($time) - strtotime($latestActivityTime);
		if($diff > 25) {		//10 seconds
				try {
			$db->query("INSERT INTO `usera_ctivity` (`userid`,`page`,`time`) VALUES ('{$userID}','{$page}','{$time}')");
				} catch (PDOException $e){ die($e->getMessage()); }
		} */
			try {
		$db->query("INSERT INTO `user_activity` (`userid`,`page`,`time`) VALUES ('{$userID}','{$page}','{$time}')");
			} catch (PDOException $e){ die($e->getMessage()); }
	}	
	
}