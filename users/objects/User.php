<?php 
class User {
	public static function checkUserVerifiedActive($db,$logInID) {
			try {
		$query = $db->query("SELECT `active` FROM `users` WHERE `loginid` = '{$logInID}'");
			} catch (PDOException $e){ die($e->getMessage()); }
		$row = $query->fetch(PDO::FETCH_ASSOC);
		if($row['active'] == 0) {
			return true;
		} else {
			return false;
		}
	}
	public static function getID($db,$email) {
			try {
		$query = $db->query("SELECT `id` FROM `users` WHERE `loginid` = '{$email}'");
			} catch (PDOException $e){ die($e->getMessage()); }
		$row = $query->fetch(PDO::FETCH_ASSOC);
		return $row['id'];
	}
	
	
	public static function getPassword($db,$logInID) {
			try {
		$query = $db->query("SELECT `password` FROM `users` WHERE `loginid` = '{$logInID}'");
			} catch (PDOException $e){ die($e->getMessage()); }
		$row = $query->fetch(PDO::FETCH_ASSOC);
		return $row['password'];
	}
	
	
	
	public static function getName($db,$logInID) {
			try {
		$query = $db->query("SELECT `name` FROM `users` WHERE `loginid` = '{$logInID}'");
			} catch (PDOException $e){ die($e->getMessage()); }
		$row = $query->fetch(PDO::FETCH_ASSOC);
		return $row['name'];
	}
	public static function getNameForID($db,$userID) {
			
			try {
		$query = $db->query("SELECT `name` FROM `users` WHERE `id` = '{$userID}'");
			} catch (PDOException $e){ die($e->getMessage()); }
		$row = $query->fetch(PDO::FETCH_ASSOC);
		return $row['name'];
	}
	public static function getUserType($db,$logInID) {
			try {
		$query = $db->query("SELECT `user_type_id` FROM `users` WHERE `loginid` = '{$logInID}'");
			} catch (PDOException $e){ die($e->getMessage()); }
		$row = $query->fetch(PDO::FETCH_ASSOC);
		return $row['user_type_id'];
	}
	public static function getUserType2($db,$userID) {
			try {
		$query = $db->query("SELECT `user_type_id` FROM `users` WHERE `id` = '{$userID}'");
			} catch (PDOException $e){ die($e->getMessage()); }
		$row = $query->fetch(PDO::FETCH_ASSOC);
		return $row['user_type_id'];
	}
	
	
	public static function getEntityID($db,$logInID) {
			try {
		$query = $db->query("SELECT `entityid` FROM `users` WHERE `loginid` = '{$logInID}'");
			} catch (PDOException $e){ die($e->getMessage()); }
		$row = $query->fetch(PDO::FETCH_ASSOC);
		return $row['entityid'];
	}
	
	
	
	
	public static function getNameWithUserID($db,$userID) {
			try {
		$query = $db->query("SELECT `name` FROM `users` WHERE `id` = '{$userID}'");
			} catch (PDOException $e){ die($e->getMessage()); }
		$row = $query->fetch(PDO::FETCH_ASSOC);
		return $row['name'];
	}
	
	
	
	public static function getUserIDwithLogInID($db,$logInID) {
			try {
		$query = $db->query("SELECT `id` FROM `users` WHERE `loginid` = '{$logInID}'");
			} catch (PDOException $e){ die($e->getMessage()); }
		$row = $query->fetch(PDO::FETCH_ASSOC);
		return $row['id'];
	}
	
	
	
	public static function changePassword($db,$logInID,$rawPassword) {
		//$password = crypt($rawPassword,CRYPT);
		$password = password_hash($rawPassword, PASSWORD_DEFAULT);
		//echo "UPDATE `users` SET `password` = '{$password}' WHERE `loginid` = '{$logInID}'";
			try {
		$db->query("UPDATE `users` SET `password` = '{$password}' WHERE `loginid` = '{$logInID}'"); return true;
			} catch (PDOException $e){ die($e->getMessage()); }
	}
	
	
	
	public static function rights($db,$logInID) {
			try {
		$query = $db->query("SELECT `rights` FROM `users` WHERE `loginid` = '{$logInID}'");
			} catch (PDOException $e){ die($e->getMessage()); }
		$row = $query->fetch(PDO::FETCH_ASSOC);
		return $row['rights'];
	}
	
	
	
	public static function checkLogInIDexists($db,$logInID) {
			try {
		$query = $db->query("SELECT COUNT(`id`) as `number` FROM `users` WHERE `loginid` = '{$logInID}' and active=0");
			} catch (PDOException $e){ die($e->getMessage()); }
		$row = $query->fetch(PDO::FETCH_ASSOC);
		if($row['number'] > 0) {
			return true;
		} else {
			return false;
		}
	}
	
	
	
	public static function addUser($db,$name,$logInID,$usertypeid) {
		$entityID = $_SESSION['entityID'];
		//$password = crypt('password',CRYPT);
		$password = password_hash('password', PASSWORD_DEFAULT);
			try {
		$db->query("INSERT INTO `users` (`entityid`,`name`,`loginid`,`password`,`rights`,`user_type_id`,`active`) VALUES ('{$entityID}','{$name}','{$logInID}','{$password}','20','{$usertypeid}',0)");
			} catch (PDOException $e){ die($e->getMessage()); }
	}
	
	
	
								//active / passive   edit / list
	public static function getList($db,$userType,$listType) {
		$entityID = $_SESSION['entityID'];
		if($userType == 'active') {
			$active = "`active` = 0";
		} else {
			$active = "`active`<> 0";
		}
			try {
		$query = $db->query("SELECT * FROM `users` WHERE  {$active} and rights<>100");

			} catch (PDOException $e){ die($e->getMessage()); }

			//echo "SELECT * FROM `users` WHERE `active` = '{$active}' AND `rights` < '100'";exit();
		$list = "<div class=\"box-body\">

                            <table class=\"table table-bordered data-table data-table-export\"><thead>
					<tr>
						<th>User Name</th>
						<th>Log In ID</th>
						<th>User Type</th>
						<th></th>
					</tr></thead>
				";
		while($row = $query->fetch(PDO::FETCH_ASSOC)) {
			


			if($listType == 'edit') {
				$editFormStart = "
									<form method=\"post\" action=\"php/users.php\" onSubmit=\"return confirm('Edit Save?');\">
								";
				$editFormEnd = "
										<td><input type=\"submit\" name=\"userEditSave\" value=\"EDIT SAVE\" class=\"btn btn-success\">
										<input type=\"hidden\" name=\"userID\" value=\"{$row['id']}\">
									</form>
									<form method=\"post\" action=\"php/users.php\" onSubmit=\"return confirm('Reset Password?');\">
										<input type=\"submit\" name=\"userResetPassword\" value=\"RESET PASSWORD\" class=\"btn btn-primary\">
											<input type=\"hidden\" name=\"userID\" value=\"{$row['id']}\">
									</form>
									<form method=\"post\" action=\"php/users.php\" onSubmit=\"return confirm('De-activate User?');\">
										<input type=\"submit\" name=\"userDeActivate\" value=\"DE-ACTIVATE USER\" class=\"btn btn-danger\">
											<input type=\"hidden\" name=\"userID\" value=\"{$row['id']}\"></td>
									</form>
								";
				$readonly="";
			} 
			else if($listType == 'inactive') {
				if($row['active']==2){
					$remarks="<p>User yet to create password</p>";
				}
				else if($row['active']==1)
				{
					$remarks="<input type=\"submit\" name=\"userActivate\" value=\"ACTIVATE\" class=\"btn btn-success\">";
				}
				$editFormStart = "
									<form method=\"post\" action=\"php/users.php\" onSubmit=\"return confirm('Are you sure?');\">
								";
				$editFormEnd = "
										<td>
										{$remarks}
										<input type=\"hidden\" name=\"userID\" value=\"{$row['id']}\">
									</form>
									
								";
								$readonly="disabled=\"disabled\"";
			} 
			else {
				$editFormStart = "";
				$editFormEnd = "";
				$readonly="";
			}
			$usertype="<select class=\"form-control\" name=\"usertypeid\" {$readonly}><option>UserType</option>";
			$usertype.=UserType::getListForSelected($db,$row['user_type_id']);
			$usertype.="</select>";
			$list .= "
						<tr>
							{$editFormStart}
							<td><input class=\"form-control\" name=\"name\" value=\"{$row['name']}\"{$readonly}></td>
							<td><input type=\"email\" class=\"form-control\" name=\"logInID\" value=\"{$row['loginid']} \"{$readonly}></td>
							<td>{$usertype}</td>
							{$editFormEnd}
						</tr>
					";
		}
		$list .= "</table></div>";
		return $list;
	}
	
	
	
	public static function checkLogInIDofUserID($db,$logInID,$userID) {
			try {
		$query = $db->query("SELECT `loginid` FROM `users` WHERE `id` = '{$userID}'");
			} catch (PDOException $e){ die($e->getMessage()); }
		$row = $query->fetch(PDO::FETCH_ASSOC);
		if($row['loginid'] == $logInID) {
			return true;
		} else {
			return false;
		}
	}
	
	
	
	
	public static function editUser($db,$name,$logInID,$usertypeid,$userID) {
			try {
		$db->query("UPDATE `users` SET `name` = '{$name}', `loginid` = '{$logInID}', `user_type_id` = '{$usertypeid}' WHERE `id` = '{$userID}'");
			} catch (PDOException $e){ die($e->getMessage()); }
	}
	
	
	
	public static function resetPassword($db,$userID) {
		//$password = crypt('password',CRYPT);
		$password = password_hash('password', PASSWORD_DEFAULT);
			try {
		$db->query("UPDATE `users` SET `password` = '{$password}' WHERE `id` = '{$userID}'");
			} catch (PDOException $e){ die($e->getMessage()); }
	}
	
	
	
	public static function deActivate($db,$userID) {
			try {
		$db->query("UPDATE `users` SET `active` = '1' WHERE `id` = '{$userID}'");
			} catch (PDOException $e){ die($e->getMessage()); }
	}
	
	public static function Activate($db,$userID) {
			try {
		$db->query("UPDATE `users` SET `active` = '0' WHERE `id` = '{$userID}'");
			} catch (PDOException $e){ die($e->getMessage()); }
	}
	public static function getListForSelect($db) {
		$entityID = $_SESSION['entityID'];
			try {
		$query = $db->query("SELECT * FROM `users` WHERE `entityid` = '{$entityID}' AND `active` = '0' AND `rights` < '90'");
			} catch (PDOException $e){ die($e->getMessage()); }
		$list = "";
		while($row = $query->fetch(PDO::FETCH_ASSOC)) {
			$list .= "<option value=\"{$row['id']}\">{$row['name']}</option>";
		}
		return $list;
	}
	public static function totalUsera($db) {
			try {
		$query = $db->query("SELECT count(*) as count FROM `users` WHERE `active` = 0");
			} catch (PDOException $e){ die($e->getMessage()); }
		$row = $query->fetch(PDO::FETCH_ASSOC);
		return $row['count'];
	}
	
	public static function getUsersListForSelect($db) {
		//$entityID = $_SESSION['entityID'];WHERE `entityid` = '{$entityID}'
			try {
		$query = $db->query("SELECT * FROM `users` where active=0 and rights<>100");
			} catch (PDOException $e){ die($e->getMessage()); }
			
			$list= "<option value=\"\" >Select -- </option>";
		while($row = $query->fetch(PDO::FETCH_ASSOC)) {
			$role_name=UserType::getName($db,$row['user_type_id']);
			$list .= "<option value=\"{$row['id']}\">{$row['name']} - [{$role_name}]</option>";
		}
		
		return $list;
	}
	public static function getUsersListForSelected($db,$id) {
		//$entityID = $_SESSION['entityID'];WHERE `entityid` = '{$entityID}'
			try {
		$query = $db->query("SELECT * FROM `users` where active=0 and rights<>100");
			} catch (PDOException $e){ die($e->getMessage()); }
			
			$list= "<option value=\"\" >Select -- </option>";
		while($row = $query->fetch(PDO::FETCH_ASSOC)) {
			if($row['id']==$id){$selected="selected=\"{$selected}\"";}else{$selected="";}
			
			$role_name=UserType::getName($db,$row['user_type_id']);
			$list .= "<option value=\"{$row['id']}\" {$selected}>{$row['name']} - [{$role_name}]</option>";
		}
		
		return $list;
	
	}
	public static function getUsersListwithAssigned($db,$taskID) {
		$getAssignedUserIDForTask=TaskAssign::getAssignedUserID($db,$taskID);
			try {
		$query = $db->query("SELECT * FROM `users` where active=0 and rights<>100");
			} catch (PDOException $e){ die($e->getMessage()); }
			
			$list= "<option value=\"\" >Select -- </option>";
		while($row = $query->fetch(PDO::FETCH_ASSOC)) {

			if($getAssignedUserIDForTask!=''){
				
				if($row['id']==$getAssignedUserIDForTask){$selected="selected=\"{$selected}\"";}else{$selected="";}
			}
			
			$role_name=UserType::getName($db,$row['user_type_id']);
			$list .= "<option value=\"{$row['id']}\" {$selected}>{$row['name']} - [{$role_name}]</option>";
		}
		
		return $list;
	
	}
}