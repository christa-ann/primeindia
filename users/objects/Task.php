<?php

class Task{
	function __construct($db,$ID) {
    //loop through product line
      try {
    $query = $db->query("SELECT * FROM task WHERE id = '{$ID}'");
      } catch (PDOException $e){ die($e->getMessage()); }
    $row = $query->fetch(PDO::FETCH_ASSOC);
    $this->id=$row['id'];
    $this->name=$row['name'];
    $this->description=$row['description'];
    $this->added_by=$row['added_by'];
    $this->added_on=$row['added_on'];
    $this->stage=$row['stage'];
 	$this->tat=$row['tat'];
      
  }

	public static function add($db,$name,$description,$tat,$added_on,$added_by,$stage) {
          $active=0;
          
         try {
    $query=$db->prepare("INSERT INTO task(`name`, `description`, `tat`, `added_on`, `added_by`, `stage`, `active`) VALUES  (:name,:description,:tat,:added_on,:added_by,:stage,:active)");
    //return true;
      } catch (PDOException $e){ die($e->getMessage()); return false;}
      $query->bindParam(':name', $name); 
     
      $query->bindParam(':description', $description); 
      $query->bindParam(':tat', $tat); 
     
      $query->bindParam(':added_on', $added_on); 
      $query->bindParam(':added_by', $added_by); 
      
      $query->bindParam(':stage', $stage);
      
      $query->bindParam(':active', $active);

      if($query->execute()){
        return true;
      }else
      {
        return false;
      }  
    }
    public static function update($db,$name,$description,$tat,$stage,$updated_by,$updated_on,$taskID) {          
          
         try {
    $query=$db->prepare("UPDATE `task` SET `name`=:name,`description`=:description,`tat`=:tat,`stage`=:stage,`updated_by`=:updated_by,`updated_on`=:updated_on where id=:taskID");
    //return true;
      } catch (PDOException $e){ die($e->getMessage()); return false;}
      $query->bindParam(':name', $name); 
     
      $query->bindParam(':description', $description); 
      $query->bindParam(':tat', $tat); 
     
      $query->bindParam(':updated_on', $updated_on); 
      $query->bindParam(':updated_by', $updated_by); 
      
      $query->bindParam(':stage', $stage);
      
     $query->bindParam(':taskID', $taskID);

      if($query->execute()){
        return true;
      }else
      {
        return false;
      }  
    }
    public static function getList($db,$userID) {
    	// $rights=User::rightsForID($db,$userID);
    	// if($rights=="100"){
    	// 	$colhead="";
    	// }
    	// else
    	// {
    	// 	$colhead="";
    	// }
		if($userID!=""){
			$user_condition=" and  active_assigned_user='{$userID}'";
		}
		else
		{
			$user_condition="";
		}
			try {
		
		
		$query = $db->query("SELECT * FROM task where active=0 {$user_condition} order by added_on desc ");

			} catch (PDOException $e){ die($e->getMessage()); }

			//echo "SELECT * FROM users WHERE active = '{$active}' AND rights < '100'";exit();
		$list = "<div class=\"box-body table-responsive\">

                            <table id=\"datatable-buttons\" class=\"table table-striped table-bordered dt-responsive nowrap\" style=\"border-collapse: collapse; border-spacing: 0; width: 100%;\"><thead>
					<tr>
						<th>Sl No</th>
						<th style=\"background-color:yellow;\">Assign/Move to</th>
						<th>Actions (By PM)</th>
						<th >Team Updates</th>
						<th>Task Name</th>
						<th>Task Description</th>
						<th>To completed by </th>
						<th>Stage </th>	
						<th>Completed On </th>
						<th>Compare TAT(Turn Around Time)</th>
						<th>Added on </th>
						<th>Added by </th>
						<th>Updated on </th>
						<th>Updated by </th>
					</tr></thead>
				";$count=1;
		while($row = $query->fetch(PDO::FETCH_ASSOC)) {
			$stage_class=TaskStage::getStageClass($db,$row['stage']); 
			$stage_name=TaskStage::getName($db,$row['stage']);
			$stage="<span class=\"badge {$stage_class}\">{$stage_name}</span>";
			$added_by_name=User::getNameForID($db,$row['added_by']);
			$updated_by_name=User::getNameForID($db,$row['updated_by']);
			
			if($userID==""){
				$action="<a href=\"edit-task.php?temp={$row['id']}\" class=\"btn btn-warning waves-effect waves-light \"><i class=\"fa fa-edit\"></i></a>&nbsp;<button class=\"btn btn-danger waves-effect waves-light deleteTask\" id=\"{$row['id']}\" ><i class=\"fa fa-trash\"></i></button>";
				$assigned_to="<select name=\"assign_to\" class=\"form-control assign\" id=\"task_{$row['id']}\">".User::getUsersListForSelected($db,$row['active_assigned_user'])."</select>";
				$team_action="<a href=\"#\" class=\"btn btn-purple waves-effect waves-light btn-sm viewNote\" data-id=\"{$row['id']}\">View </a>";
			}
			else{
				$action="";
				$assigned_to="<span class=\"badge badge-warning\">".User::getNameForID($db,$userID)."</span>";
				$team_action="<a href=\"#\" class=\"btn btn-dark waves-effect waves-light btn-sm updateNote \" data-id=\"{$row['id']}\" >Update Notes</a><br><br><a href=\"#\" class=\"btn btn-purple waves-effect waves-light btn-sm viewNote\" data-id=\"{$row['id']}\">View Notes</a>";
			}
			if($row['tat']!='' && $row['added_on']!=''){
				$expected_tat=self::findExpectedTAT($db,$row['tat'],$row['added_on']);
			}
			else
			{
				$expected_tat=0;
			}
			if($row['added_on']!='' && $row['completion_date']!=''){
				$actual_tat=self::findExpectedTAT($db,$row['added_on'],$row['completion_date']);
			}
			else
			{
				$actual_tat=0;
			}
			
			$list .= "
						<tr>
							<td>{$count}</td>
							<td style=\"background-color:yellow;\">{$assigned_to}</td>
							<td style=\"width:150px;\"> {$action} </td>
							<td>{$team_action}</td>
							<td>{$row['name']} </td>
							<td style=\"white-space:break-spaces;\">{$row['description']}</td>
							<td style=\"width:40px;\">{$row['tat']}</td>							
							<td>{$stage}</td>
							<td>{$row['completion_date']}</td>
							<td><p>Expected TAT: {$expected_tat}</p><p>Actual TAT: {$actual_tat}</p></td>
							<td>{$row['added_on']}</td>
							<td>{$added_by_name}</td>
							<td>{$row['updated_on']}</td>
							<td>{$updated_by_name}</td>
						</tr>
					";
			$count++;
		}
		if($query->rowcount()==0){
			$list.="<tr><td colspan=\"5\"> No Tasks added.</td></tr>";
		}
		$list .= "</table></div>";
		return $list;
	}
	public static function deactivate($db,$rowID) {
		$active=1;
			try {
		$query=$db->prepare("UPDATE `task` SET `active` = 1 WHERE `id` = :rowID"); 
			} catch (PDOException $e){ die($e->getMessage()); }

			// $query->bindParam(':active', $active);
			$query->bindParam(':rowID', $rowID);

	      if($query->execute()){
	        return true;
	      }else
	      {
	        return false;
	      }  
	}
	public static function updateAssign($db,$taskID,$userID) {
		$active=1;
			try {
		$query=$db->prepare("UPDATE `task` SET `active_assigned_user` = :userID WHERE `id` = :taskID"); 
			} catch (PDOException $e){ die($e->getMessage()); }

		    $query->bindParam(':userID', $userID);
			$query->bindParam(':taskID', $taskID);

	      if($query->execute()){
	        return true;
	      }else
	      {
	        return false;
	      }  
	}
	public static function updateCompletion($db,$taskID) {
		$completion_date=date("Y-m-d H:i:s");
		try{
		$query=$db->prepare("UPDATE `task` SET `completion_date` = :completion_date WHERE `id` = :taskID"); 
			} catch (PDOException $e){ die($e->getMessage()); }

		    $query->bindParam(':completion_date', $completion_date);
			$query->bindParam(':taskID',$taskID);

	      if($query->execute()){
	        return true;
	      }else
	      {
	        return false;
	      }  
	}
	public static function totalTasks($db,$date,$stage) {
		$stage_condn=($stage!='')?"and stage='{$stage}'":"";
		$date_condn=($date!='')?"and added_on  LIKE '{$date}%'":"";
			try {
		$query = $db->query("SELECT count(*) as count FROM `task` WHERE `active` = 0 {$stage_condn} {$date_condn}");
			} catch (PDOException $e){ die($e->getMessage()); }
		$row = $query->fetch(PDO::FETCH_ASSOC);
		return $row['count'];
	}
	public static function findExpectedTAT($db,$date1,$date2) {
		if(strtotime($date2)>strtotime($date1)){
		    $diff = abs(strtotime($date2) - strtotime($date1)); 
		}
		else if(strtotime($date1)>strtotime($date2))
		{
		    $diff = abs(strtotime($date1) - strtotime($date2)); 
		}
		$out='';
		$years   = floor($diff / (365*60*60*24)); 
		$months  = floor(($diff - $years * 365*60*60*24) / (30*60*60*24)); 
		$days    = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

		$hours   = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24)/ (60*60)); 

		$minuts  = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60)/ 60); 

		$seconds = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60 - $minuts*60)); 

		if($year!=0){$out.="{$years} years,";}else{$out.='';}
		if($months!=0){$out.="{$months} months,";}else{$out.='';}
		if($days!=0){$out.="{$days} days,";}else{$out.='';}
		if($hours!=0){$out.="{$hours} hours,";}else{$out.='';}
		if($minuts!=0){$out.="{$minuts} minutes,";}else{$out.='';}
		if($seconds!=0){$out.="{$seconds} seconds";}else{$out.='';}

		//$out="$years years, $months months, $days days,$hours hours, $minuts minutes, $seconds seconds";

		return $out;
		//printf("%d years, %d months, %d days, %d hours, %d minutsn, %d secondsn", $years, $months, $days, $hours, $minuts, $seconds); 
	}
	public static function getReport($db,$userID) {
    	// $rights=User::rightsForID($db,$userID);
    	// if($rights=="100"){
    	// 	$colhead="";
    	// }
    	// else
    	// {
    	// 	$colhead="";
    	// }
		if($userID!=""){
			$user_condition=" and  active_assigned_user='{$userID}'";
		}
		else
		{
			$user_condition="";
		}
			try {
		
		
		$query = $db->query("SELECT * FROM task where active=0 {$user_condition} order by added_on desc ");

			} catch (PDOException $e){ die($e->getMessage()); }

			//echo "SELECT * FROM users WHERE active = '{$active}' AND rights < '100'";exit();
		$list = "<div class=\"box-body table-responsive\">

                            <table id=\"datatable-buttons\" class=\"table table-striped table-bordered dt-responsive nowrap\" style=\"border-collapse: collapse; border-spacing: 0; width: 100%;\"><thead>
					<tr>
						<th>Sl No</th>
						<th>Assigned to</th>
						
						<th >Team Updates</th>
						<th>Task Name</th>
						<th>Task Description</th>
						<th>To completed by </th>
						<th>Stage </th>	
						<th>Completed On </th>
						<th>Compare TAT(Turn Around Time)</th>
						<th>Added on </th>
						<th>Added by </th>
						<th>Updated on </th>
						<th>Updated by </th>
					</tr></thead>
				";$count=1;
		while($row = $query->fetch(PDO::FETCH_ASSOC)) {
			$stage_class=TaskStage::getStageClass($db,$row['stage']); 
			$stage_name=TaskStage::getName($db,$row['stage']);
			$stage="<span class=\"badge {$stage_class}\">{$stage_name}</span>";
			$added_by_name=User::getNameForID($db,$row['added_by']);
			$updated_by_name=User::getNameForID($db,$row['updated_by']);
			$assigned_to=User::getNameForID($db,$row['active_assigned_user']);
			if($userID==""){
				//$action="<a href=\"edit-task.php?temp={$row['id']}\" class=\"btn btn-warning waves-effect waves-light \"><i class=\"fa fa-edit\"></i></a>&nbsp;<button class=\"btn btn-danger waves-effect waves-light deleteTask\" id=\"{$row['id']}\" ><i class=\"fa fa-trash\"></i></button>";
				//$assigned_to="<select name=\"assign_to\" class=\"form-control assign\" id=\"task_{$row['id']}\">".User::getUsersListForSelected($db,$row['active_assigned_user'])."</select>";
				//$team_action="<a href=\"#\" class=\"btn btn-purple waves-effect waves-light btn-sm viewNote\" data-id=\"{$row['id']}\">View </a>";
			}
			else{
				//$action="";
				//$assigned_to="<span class=\"badge badge-warning\">".User::getNameForID($db,$userID)."</span>";
				//$team_action="<a href=\"#\" class=\"btn btn-dark waves-effect waves-light btn-sm updateNote \" data-id=\"{$row['id']}\" >Update Notes</a><br><br><a href=\"#\" class=\"btn btn-purple waves-effect waves-light btn-sm viewNote\" data-id=\"{$row['id']}\">View Notes</a>";
			}
			if($row['tat']!='' && $row['added_on']!=''){
				$expected_tat=self::findExpectedTAT($db,$row['tat'],$row['added_on']);
			}
			else
			{
				$expected_tat=0;
			}
			if($row['added_on']!='' && $row['completion_date']!=''){
				$actual_tat=self::findExpectedTAT($db,$row['added_on'],$row['completion_date']);
			}
			else
			{
				$actual_tat=0;
			}
			$taskUpdates=TaskUpdate::getReport($db,$row['id']);;
			$list .= "
						<tr>
							<td>{$count}</td>
							<td>{$assigned_to}</td>
							
							<td>{$taskUpdates}</td>
							<td>{$row['name']} </td>
							<td style=\"white-space:break-spaces;\">{$row['description']}</td>
							<td style=\"width:40px;\">{$row['tat']}</td>							
							<td>{$stage}</td>
							<td>{$row['completion_date']}</td>
							<td><p>Expected TAT: {$expected_tat}</p><p>Actual TAT: {$actual_tat}</p></td>
							<td>{$row['added_on']}</td>
							<td>{$added_by_name}</td>
							<td>{$row['updated_on']}</td>
							<td>{$updated_by_name}</td>
						</tr>
					";
			$count++;
		}
		if($query->rowcount()==0){
			$list.="<tr><td colspan=\"5\"> No Tasks added.</td></tr>";
		}
		$list .= "</table></div>";
		return $list;
	}
	public static function getSingleTask($db,$taskID,$field) {
    	
			try {		
		
		$query = $db->query("SELECT {$field} FROM task where active=0 and id='{$taskID}' ");

			} catch (PDOException $e){ die($e->getMessage()); }

		$row = $query->fetch(PDO::FETCH_ASSOC);
		return $row[$field];
	}
	
}

?>