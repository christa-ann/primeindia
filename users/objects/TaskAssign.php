<?php
/**
 * Class to assign task to team members
 */
class TaskAssign 
{
	
	// function __construct(argument)
	// {
	// 	# code...
	// }
	public static function getAssignedUserID($db,$taskID) {
		//echo "SELECT userID FROM `task_assign` WHERE `taskID` = '{$taskID}' order by added_on desc limit 1";exit();
			try {
		$query = $db->query("SELECT userID FROM `task_assign` WHERE `taskID` = '{$taskID}' order by assign_on desc limit 1");
			} catch (PDOException $e){ die($e->getMessage()); }
		$row = $query->fetch(PDO::FETCH_ASSOC);
		return $row['userID'];
	}
}
?>