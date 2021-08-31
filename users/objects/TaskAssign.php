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
		$query = $db->query("SELECT userID FROM `task_assign` WHERE `taskID` = '{$taskID}'");
			} catch (PDOException $e){ die($e->getMessage()); }
		$row = $query->fetch(PDO::FETCH_ASSOC);
		return $row['userID'];
	}
	public static function checkEntry($db,$taskID,$userID) {
		//echo "SELECT userID FROM `task_assign` WHERE `taskID` = '{$taskID}' order by added_on desc limit 1";exit();
			try {
		$query = $db->query("SELECT count(*) as count FROM `task_assign` WHERE `taskID` = '{$taskID}' and userID='{$userID}'");
			} catch (PDOException $e){ die($e->getMessage()); }
		$row = $query->fetch(PDO::FETCH_ASSOC);
		return $row['count'];
	}
	public static function add($db,$taskID,$userID,$assigned_on,$assigned_by) {
          $active=0;
          
         try {
    $query=$db->prepare("INSERT INTO task_assign(`taskID`, `userID`, `assign_on`, `assigned_by`) VALUES  (:taskID,:userID,:assigned_on,:assigned_by)");
    //return true;
      } catch (PDOException $e){ die($e->getMessage()); return false;}
      $query->bindParam(':taskID', $taskID); 
     
      $query->bindParam(':userID', $userID); 
      $query->bindParam(':assigned_on', $assigned_on); 
     
      $query->bindParam(':assigned_by', $assigned_by); 
      

      if($query->execute()){
        return true;
      }else
      {
        return false;
      }  
    }
}
?>