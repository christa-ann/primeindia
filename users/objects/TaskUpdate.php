<?php

class TaskUpdate{
	function __construct($db,$ID) {
    //loop through product line
      try {
    $query = $db->query("SELECT * FROM task_updates WHERE id = '{$ID}'");
      } catch (PDOException $e){ die($e->getMessage()); }
    $row = $query->fetch(PDO::FETCH_ASSOC);
    $this->id=$row['id'];
    $this->updates=$row['updates'];
    $this->taskID=$row['taskID'];
    $this->media=$row['media'];
    $this->media_link=$row['media_link'];
    $this->added_by=$row['added_by'];
 	  $this->added_on=$row['added_on'];
      
  }
  public static function getList($db,$taskID) {
     
    if($userID!=""){
      $user_condition=" and  active_assigned_user='{$userID}'";
    }
    else
    {
      $user_condition="";
    }
      try {
    
    
    $query = $db->query("SELECT * FROM task_updates where active=0 and taskID='{$taskID}' order by added_on desc ");

      } catch (PDOException $e){ die($e->getMessage()); }

      //echo "SELECT * FROM users WHERE active = '{$active}' AND rights < '100'";exit();
    $list = "<div class=\"box-body table-responsive\">

                            <table id=\"datatable\" class=\"table table-striped table-bordered dt-responsive nowrap\" style=\"border-collapse: collapse; border-spacing: 0; width: 100%;\"><thead>
          <tr>
            <th>Sl No</th>
            <th>Updates</th>
            <th>Media</th>
            <th>Media Link</th>           
            <th>Added on </th>
            <th>Added by </th>
            <th>Updated on </th>
            <th>Updated by </th>
            <th>Actions (By PM)</th>
          
          </tr></thead>
        ";$count=1;
    while($row = $query->fetch(PDO::FETCH_ASSOC)) {
     
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
      $list .= "
            <tr>
              <td>{$count}</td>
              
              <td style=\"white-space:break-spaces;\">{$row['updates']}</td>
              <td>{$row['media']}</td>              
              <td>{$row['media_link']}</td>
              <td>{$row['added_on']}</td>
              <td>{$added_by_name}</td>
              <td>{$row['updated_on']}</td>
              <td>{$updated_by_name}</td>
              <td style=\"width:150px;\"> {$action} </td>
              
            </tr>
          ";
      $count++;
    }
    if($query->rowcount()==0){
      $list.="<tr><td colspan=\"9\"> No Updates added.</td></tr>";
    }
    $list .= "</table></div>";
    return $list;
  }

}

?>