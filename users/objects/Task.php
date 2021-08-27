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
    public static function getList($db,$userID) {
    	if($userID!=""){
    		$user_sql="and added_by='{$userID}'";
    	}
    	else
    	{
    		$user_sql="";
    	}
		
			try {
		$query = $db->query("SELECT * FROM task where active=0 order by added_on desc ");

			} catch (PDOException $e){ die($e->getMessage()); }

			//echo "SELECT * FROM users WHERE active = '{$active}' AND rights < '100'";exit();
		$list = "<div class=\"box-body table-responsive\">

                            <table id=\"datatable-buttons\" class=\"table table-striped table-bordered dt-responsive nowrap\" style=\"border-collapse: collapse; border-spacing: 0; width: 100%;\"><thead>
					<tr>
						<th>Sl No</th>
						<th>Name</th>
						<th>Description</th>
						<th>Turn Around Time (days)</th>
						<th>Stage </th>	
						<th>Added on </th>
						<th>Added by </th>
						<th>Updated on </th>
						<th>Updated by </th>
						<th>Actions</th>
						<th style=\"background-color:yellow;\">Assign to</th>
						<th >Team Updates</th>
					</tr></thead>
				";$count=1;
		while($row = $query->fetch(PDO::FETCH_ASSOC)) {
			$stage_class=TaskStage::getStageClass($db,$row['stage']); 
			$stage_name=TaskStage::getName($db,$row['stage']);
			$stage="<span class=\"badge {$stage_class}\">{$stage_name}</span>";
			$added_by_name=User::getNameForID($db,$row['added_by']);
			$updated_by_name=User::getNameForID($db,$row['updated_by']);
			$assigned_to="<select name=\"assign_to\" class=\"form-control\">".User::getUsersListwithAssigned($db,$row['id'])."</select>";
			$list .= "
						<tr>
							<td>{$count}</td>
							<td>{$row['name']} </td>
							<td style=\"white-space:break-spaces;\">{$row['description']}</td>
							<td style=\"width:40px;\">{$row['tat']}</td>							
							<td>{$stage}</td>
							<td>{$row['added_on']}</td>
							<td>{$added_by_name}</td>
							<td>{$row['updated_on']}</td>
							<td>{$updated_by_name}</td>
							<td style=\"width:150px;\"> <a href=\"edit-task.php?temp={$row['id']}\" class=\"btn btn-warning waves-effect waves-light \"><i class=\"fa fa-edit\"></i></a>&nbsp;<button class=\"btn btn-danger waves-effect waves-light deleteExpense\" id=\"{$row['id']}\" ><i class=\"fa fa-trash\"></i></button> </td>
							<td style=\"background-color:yellow;\">{$assigned_to}</td>
							<td></td>
						</tr>
					";
			$count++;
		}
		if($query->rowcount()==0){
			$list.="<tr><td colspan=\"5\"> No Expenses added.</td></tr>";
		}
		$list .= "</table></div>";
		return $list;
	}
}

?>