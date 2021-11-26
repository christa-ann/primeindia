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
        $action="<a href=\"#\" class=\"btn btn-warning btn-sm waves-effect waves-light editTaskUpdate \" data-id=\"{$row['id']}\"><i class=\"fa fa-edit\"></i></a>&nbsp;<button class=\"btn btn-danger btn-sm waves-effect waves-light deleteTaskUpdate\" data-id=\"{$row['id']}\" data-task=\"{$row['taskID']}\" ><i class=\"fa fa-trash\"></i></button>";
        $assigned_to="<select name=\"assign_to\" class=\"form-control assign\" id=\"task_{$row['id']}\">".User::getUsersListForSelected($db,$row['active_assigned_user'])."</select>";
        
      }
      else{
        $action="";
        $assigned_to="<span class=\"badge badge-warning\">".User::getNameForID($db,$userID)."</span>";
       
      }
      $media_path=($row['media']!='')?HOST."/mediafiles/".$row['media']:"";
      $media_display=($row['media']!='')?"<a href=\"{$media_path}\" target=\"_blank\">{$row['media']}</a>":"";
      $media_link_display=($row['media_link']!='')?"<a href=\"{$row['media_link']}\" target=\"_blank\">View</a>":"No Links Attached";
      $list .= "
            <tr>
              <td>{$count}</td>
              
              <td style=\"white-space:break-spaces;\">{$row['updates']}</td>
              <td>{$media_display}</td>              
              <td>{$media_link_display}</td>
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
   public static function add($db,$taskID,$updates,$media,$media_link,$added_on,$added_by) {
          $active=0;
          
         try {
    $query=$db->prepare("INSERT INTO task_updates(`taskID`, `updates`, `media`, `media_link`, `added_by`, `added_on`, `active`) VALUES  (:taskID,:updates,:media,:media_link,:added_by,:added_on,:active)");

      } catch (PDOException $e){ die($e->getMessage()); return false;}
      $query->bindParam(':taskID', $taskID); 
     
      $query->bindParam(':updates', $updates); 
      $query->bindParam(':media', $media); 
      $query->bindParam(':media_link', $media_link);
      $query->bindParam(':added_on', $added_on); 
      $query->bindParam(':added_by', $added_by);     
      $query->bindParam(':active', $active);

      if($query->execute()){
        return true;
      }else
      {
        return false;
      }  
    }
    public static function getSingleTaskUpdates($db,$taskUpdateID){
    
    try{

     $query=$db->query("SELECT * FROM `task_updates` WHERE id='{$taskUpdateID}'  ");
        
      } 
      catch (PDOException $e){ die($e->getMessage()); }
    $row = $query->fetch(PDO::FETCH_ASSOC);
    
    return $row;
      
  }
  public static function deactivate($db,$rowID) {
    $active=1;
      try {
    $query=$db->prepare("UPDATE `task_updates` SET `active` = 1 WHERE `id` = :rowID"); 
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
  public static function update($db,$rowID,$updates,$media_doc,$media_link,$updated_on,$updated_by) {          
          
         try {
    $query=$db->prepare("UPDATE `task_updates` SET `updates`=:updates,`media`=:media_doc,`media_link`=:media_link,`updated_by`=:updated_by,`updated_on`=:updated_on where id=:rowID");
    //return true;
      } catch (PDOException $e){ die($e->getMessage()); return false;}
      $query->bindParam(':updates', $updates); 
     
      $query->bindParam(':media_doc', $media_doc); 
      $query->bindParam(':media_link', $media_link); 
     
      $query->bindParam(':updated_on', $updated_on); 
      $query->bindParam(':updated_by', $updated_by);
      
      $query->bindParam(':rowID', $rowID);

      if($query->execute()){
        return true;
      }else
      {
        return false;
      }  
    }
    public static function getReport($db,$taskID) {
     
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
           
          
          </tr></thead>
        ";$count=1;
    while($row = $query->fetch(PDO::FETCH_ASSOC)) {
     
      $added_by_name=User::getNameForID($db,$row['added_by']);
      $updated_by_name=User::getNameForID($db,$row['updated_by']);
      
      if($userID==""){
        $action="<a href=\"#\" class=\"btn btn-warning btn-sm waves-effect waves-light editTaskUpdate \" data-id=\"{$row['id']}\"><i class=\"fa fa-edit\"></i></a>&nbsp;<button class=\"btn btn-danger btn-sm waves-effect waves-light deleteTaskUpdate\" data-id=\"{$row['id']}\" data-task=\"{$row['taskID']}\" ><i class=\"fa fa-trash\"></i></button>";
        $assigned_to="<select name=\"assign_to\" class=\"form-control assign\" id=\"task_{$row['id']}\">".User::getUsersListForSelected($db,$row['active_assigned_user'])."</select>";
        
      }
      else{
        $action="";
        $assigned_to="<span class=\"badge badge-warning\">".User::getNameForID($db,$userID)."</span>";
       
      }
      $media_path=($row['media']!='')?HOST."/mediafiles/".$row['media']:"";
      $media_display=($row['media']!='')?"<a href=\"{$media_path}\" target=\"_blank\">{$row['media']}</a>":"";
      $media_link_display=($row['media_link']!='')?"<a href=\"{$row['media_link']}\" target=\"_blank\">View</a>":"No Links Attached";
      $list .= "
            <tr>
              <td>{$count}</td>
              
              <td style=\"white-space:break-spaces;\">{$row['updates']}</td>
              <td>{$media_display}</td>              
              <td>{$media_link_display}</td>
              <td>{$row['added_on']}</td>
              <td>{$added_by_name}</td>
              <td>{$row['updated_on']}</td>
              <td>{$updated_by_name}</td>
              
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