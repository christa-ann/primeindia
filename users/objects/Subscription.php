<?php 
class Subscription {
	
	public static function addMonth($db,$month) {
		$date = new DateTime($month);
		$monthSave = $date->format('Y-m');
			try {
		$db->query("INSERT INTO `subscription` (`userid`,`month`,`date_create`) VALUES ('{$_SESSION['userID']}','{$monthSave}','".date('Y-m-d H:i:s')."')");
			} catch (PDOException $e){ die($e->getMessage()); }
	}
	
	
	
	public static function allowedMonths($db) {
			try {
		$query = $db->query("SELECT * FROM `subscription` ORDER BY `month` DESC");
			} catch (PDOException $e){ die($e->getMessage()); }
		$list = "
			<table class=\"table\">
		";
		while($row = $query->fetch(PDO::FETCH_ASSOC)) {
			$list .= "
						<tr>
							<td>{$row['month']}</td>
						</tr>
					";
		}
		$list .= "</table>";
		return $list;
	}
	
	
	
	public static function validTill($db) {
			try {
		$query = $db->query("SELECT * FROM `subscription` ORDER BY `month` DESC LIMIT 1");
			} catch (PDOException $e){ die($e->getMessage()); }
		$row = $query->fetch(PDO::FETCH_ASSOC);
		$month = new DateTime($row['month']);
		return $month->format('t M, Y');
	}
	
	
	
	public static function warningExpiry($db) {
			try {
		$query = $db->query("SELECT * FROM `subscription` ORDER BY `id` DESC LIMIT 1");
			} catch (PDOException $e){ die($e->getMessage()); }
		$row = $query->fetch(PDO::FETCH_ASSOC);
		
		$date1 = new DateTime("{$row['allowed_till']}");
		$date2 = new DateTime("today"); // Can use date/string just like strtotime.
		//var_dump($date2 > $date1);
		$interval = $date2->diff($date1);
		$days = $interval->days;
		if($date1 < $date2) {
			header("Location: ".HOST."/expired.php");
			exit();
		}
		if($days <= 15) {
			return "<h3 style=\"color:red;\">This subscription will end in {$days} days.  Kindly renew to continue using all the modules.</h3>";
		}
		
	}
	
	
	
	
	
	
	
	
	
}