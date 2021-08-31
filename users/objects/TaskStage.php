<?php

class TaskStage{
	public static function getName($db,$id) {
			try {
		$query = $db->query("SELECT `name` FROM `task_stages` WHERE `id` = '{$id}'");
			} catch (PDOException $e){ die($e->getMessage()); }
		$row = $query->fetch(PDO::FETCH_ASSOC);
		return $row['name'];
	}
	public static function getStageClass($db,$stage) {
			if($stage==1){
				$stage_Class="badge-info";
			}
			else if($stage==2){
				$stage_Class="badge-warning";
			}
			else if($stage==3){
				$stage_Class="badge-pink";
			}
			else if($stage==4){
				$stage_Class="badge-danger";
			}
		return $stage_Class;
	}
	public static function getListForSelect($db) {
		//$entityID = $_SESSION['entityID'];WHERE `entityid` = '{$entityID}'
			try {
		$query = $db->query("SELECT * FROM `task_stages` where active=0 ");
			} catch (PDOException $e){ die($e->getMessage()); }
			
			$list= "<option value=\"\" >Select -- </option>";
		while($row = $query->fetch(PDO::FETCH_ASSOC)) {
			
			$list .= "<option value=\"{$row['id']}\">{$row['name']} </option>";
		}
		
		return $list;
	}
	public static function getListForSelected($db,$id) {
		//$entityID = $_SESSION['entityID'];WHERE `entityid` = '{$entityID}'
			try {
		$query = $db->query("SELECT * FROM `task_stages` where active=0 ");
			} catch (PDOException $e){ die($e->getMessage()); }
			
			$list= "<option value=\"\" >Select -- </option>";
		while($row = $query->fetch(PDO::FETCH_ASSOC)) {
			if($row['id']==$id)
				{$selected="selected=\"selected\"";}
			else{$selected="";}
			
			
			$list .= "<option value=\"{$row['id']}\" {$selected}>{$row['name']} </option>";
		}
		
		return $list;
	
	}
}
?>