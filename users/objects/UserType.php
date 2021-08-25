<?php 
class UserType {
	
	public static function addUserType($db,$name) {
		//$entityID = $_SESSION['entityID'];
			try {
		$db->query("INSERT INTO `user_type` (`name`) VALUES ('{$name}')");
			} catch (PDOException $e){ die($e->getMessage()); }
	}
	
	
	
								//active / passive   edit / list
	public static function getList($db,$listType) {
		//$entityID = $_SESSION['entityID'];WHERE `entityid` = '{$entityID}'
		if($departmentType == 'active') {
			$active = 0;
		} else {
			$active = 1;
		}
		//echo "success";
			try {
		$query = $db->query("SELECT * FROM `user_type` ");
			} catch (PDOException $e){ die($e->getMessage()); }
		$list = "<div class=\"box-body\">

                            <table class=\"table table-bordered data-table data-table-export\"><thead>
					<tr>
						<th> Name</th>
						
						<th></th>
					</tr></thead>";
		while($row = $query->fetch(PDO::FETCH_ASSOC)) {
			if($listType == 'edit') {
				$editFormStart = "
									<form method=\"post\" action=\"php/usertype.php\" onSubmit=\"return confirm('Do you want to save these changes?');\">
								";
				$editFormEnd = "
										<td><input type=\"submit\" name=\"usertypeEditSave\" value=\"EDIT & SAVE\" class=\"btn btn-success\"></td>
										<input type=\"hidden\" name=\"usertypeID\" value=\"{$row['id']}\">
									</form>
								";
			} else {
				$editFormStart = "";
				$editFormEnd = "";
			}
			$list .= "
						<tr>
							{$editFormStart}
							<td><input class=\"form-control\" name=\"name\" value=\"{$row['name']}\"></td>
							{$editFormEnd}
						</tr>
					";
		}
		$list .= "</table></div>";
		return $list;
	}
	
	
	
	
	public static function editUserType($db,$name,$usertypeID) {
			try {
		$db->query("UPDATE `user_type` SET `name` = '{$name}' WHERE `id` = '{$usertypeID}'");
			} catch (PDOException $e){ die($e->getMessage()); }
	}
	
	
	
	
	public static function getListForSelect($db) {
		//$entityID = $_SESSION['entityID'];WHERE `entityid` = '{$entityID}'
			try {
		$query = $db->query("SELECT * FROM `user_type` ");
			} catch (PDOException $e){ die($e->getMessage()); }
		$list = "";
		while($row = $query->fetch(PDO::FETCH_ASSOC)) {
			$list .= "<option value=\"{$row['id']}\">{$row['name']}</option>";
		}
		return $list;
	}
	public static function getListForSelected($db,$usertypeid) {
		//$entityID = $_SESSION['entityID'];
			try {
		$query = $db->query("SELECT * FROM `user_type` ");
			} catch (PDOException $e){ die($e->getMessage()); }
		$list = "";
		while($row = $query->fetch(PDO::FETCH_ASSOC)) {
			if($row['id']==$usertypeid)
			{
				$selected="selected=\"{$selected}\"";
			}
			else
				$selected="";

			$list .= "<option value=\"{$row['id']}\" {$selected}>{$row['name']}</option>";
		}
		return $list;
	}
	
	
	public static function getName($db,$usertypeID) {
			try {
		$query = $db->query("SELECT `name` FROM `user_type` WHERE `id` = '{$usertypeID}'");
			} catch (PDOException $e){ die($e->getMessage()); }
		$row = $query->fetch(PDO::FETCH_ASSOC);
		return $row['name'];
	}
	
	
}