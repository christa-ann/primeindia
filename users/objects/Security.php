<?php 
class Security {
	
	public static function generateNewSecurity($userID) {
		$security = crypt(rand(),'randomlyGeneratedSaltForHello');
		$security .= crypt(rand(),'randomlyGeneratedSaltForHello');
		$security .= crypt(rand(),'randomlyGeneratedSaltForHello');
		$security .= crypt(rand(),'randomlyGeneratedSaltForHello');
		$security .= crypt(rand(),'randomlyGeneratedSaltForHello');
		$security .= $userID;
		$security .= crypt(rand(),'randomlyGeneratedSaltForHello');
		$security .= crypt(rand(),'randomlyGeneratedSaltForHello');
		return $security;
	}
	
	
	public static function checkSecurityExists($db,$securityText) {
			try {
		$query = $db->query("SELECT COUNT(id) as number FROM `users` WHERE `security` = '{$securityText}'");
			} catch (PDOException $e){ die($e->getMessage()); }
		$row = $query->fetch(PDO::FETCH_ASSOC);
		if($row['number'] > 0) {
			$length = strlen($securityText);
			$userIDLength = $length - 13*7;
			$userID = substr($securityText,13*5,$userIDLength);
			return $userID;
		} else {
			return false;
		}
	}
	
	
	
	public static function checkSecurityExistsGiveAsk($db,$securityText) {
			try {
		$query = $db->query("SELECT COUNT(id) as number FROM `users` WHERE `security_giveask` = '{$securityText}'");
			} catch (PDOException $e){ die($e->getMessage()); }
		$row = $query->fetch(PDO::FETCH_ASSOC);
		if($row['number'] > 0) {
			$length = strlen($securityText);
			$userIDLength = $length - 13*7;
			$userID = substr($securityText,13*5,$userIDLength);
			return $userID;
		} else {
			return false;
		}
	}
	
	
	
	public static function insertSecurity($db,$userID,$security) {
			try {
		$db->query("UPDATE `users` SET `security` = '{$security}' WHERE `id` = '{$userID}'");
			} catch (PDOException $e){ die($e->getMessage()); }
	}
	
	
	
	public static function getSecurityText($db,$userID) {
			try {
		$query = $db->query("SELECT `security` FROM `users` WHERE `id` = '{$userID}'");
			} catch (PDOException $e){ die($e->getMessage()); }
		$row = $query->fetch(PDO::FETCH_ASSOC);
		return $row['security'];
	}
	
	
	
	public static function updateSecurityText($db,$userID,$securityText) {
			try {
		$db->query("UPDATE `users` SET `security` = '{$securityText}' WHERE `id` = '{$userID}'");
			} catch (PDOException $e){ die($e->getMessage()); }
	}
	
	
	
	public static function updateSecurityTextGiveAsk($db,$userID,$securityText) {
			try {
		$db->query("UPDATE `users` SET `security_giveask` = '{$securityText}' WHERE `id` = '{$userID}'");
			} catch (PDOException $e){ die($e->getMessage()); }
	}
	
	
	
	public static function checkUserVerifiedActive($db,$email) {
			try {
		$query = $db->query("SELECT `active` FROM `users` WHERE `email` = '{$email}'");
			} catch (PDOException $e){ die($e->getMessage()); }
		$row = $query->fetch(PDO::FETCH_ASSOC);
		if($row['active'] == 0) {
			return false;
		} else {
			return true;
		}
	}
	
	
	
	public static function getPassword($db,$logInID) {
			try {
		$query = $db->query("SELECT `password` FROM `users` WHERE `loginid` = '{$logInID}'");
			} catch (PDOException $e){ die($e->getMessage()); }
		$row = $query->fetch(PDO::FETCH_ASSOC);
		return $row['password'];
	}
	
	
	
	public static function changePassword($db,$logInID,$rawPassword) {
		$password = crypt($rawPassword,CRYPT);
			try {
		$db->query("UPDATE `users` SET `password` = '{$password}' WHERE `loginid` = '{$logInID}'");
			} catch (PDOException $e){ die($e->getMessage()); }
	}
	
	
	
	public static function rights($db,$email) {
			try {
		$query = $db->query("SELECT `rights` FROM `users` WHERE `email` = '{$email}'");
			} catch (PDOException $e){ die($e->getMessage()); }
		$row = $query->fetch(PDO::FETCH_ASSOC);
		return $row['rights'];
	}
	
	
	
	public static function checkLogInIDexists($db,$logInID) {
			try {
		$query = $db->query("SELECT COUNT(`id`) as `number` FROM `users` WHERE `loginid` = '{$logInID}'");
			} catch (PDOException $e){ die($e->getMessage()); }
		$row = $query->fetch(PDO::FETCH_ASSOC);
		if($row['number'] > 0) {
			return true;
		} else {
			return false;
		}
	}
	
	
	
	public static function addUser($db,$name,$logInID) {
		$password = crypt('password',CRYPT);
			try {
		$db->query("INSERT INTO `users` (`name`,`loginid`,`password`,`rights`) VALUES ('{$name}','{$logInID}','{$password}','20')");
			} catch (PDOException $e){ die($e->getMessage()); }
	}
	
	
	
								//active / passive   edit / list
	public static function getList($db,$userType,$listType) {
		if($userType == 'active') {
			$active = 0;
		} else {
			$active = 1;
		}
			try {
		$query = $db->query("SELECT * FROM `users` WHERE `active` = '{$active}' AND `rights` < '100'");
			} catch (PDOException $e){ die($e->getMessage()); }
		$list = "<table class=\"table\">";
		while($row = $query->fetch(PDO::FETCH_ASSOC)) {
			if($listType == 'edit') {
				$editFormStart = "
									<form method=\"post\" action=\"php/users.php\" onSubmit=\"return confirm('Edit Save?');\">
								";
				$editFormEnd = "
										<td><input type=\"submit\" name=\"userEditSave\" value=\"EDIT SAVE\" class=\"btn btn-success\"></td>
										<input type=\"hidden\" name=\"userID\" value=\"{$row['id']}\">
									</form>
									<form method=\"post\" action=\"php/users.php\" onSubmit=\"return confirm('Reset Password?');\">
										<td><input type=\"submit\" name=\"userResetPassword\" value=\"RESET PASSWORD\" class=\"btn btn-primary\"></td>
											<input type=\"hidden\" name=\"userID\" value=\"{$row['id']}\">
									</form>
									<form method=\"post\" action=\"php/users.php\" onSubmit=\"return confirm('De-activate User?');\">
										<td><input type=\"submit\" name=\"userDeActivate\" value=\"DE-ACTIVATE USER\" class=\"btn btn-danger\"></td>
											<input type=\"hidden\" name=\"userID\" value=\"{$row['id']}\">
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
							<td><input class=\"form-control\" name=\"logInID\" value=\"{$row['loginid']}\"></td>
							{$editFormEnd}
						</tr>
					";
		}
		$list .= "</table>";
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
	
	
	
	
	public static function editUser($db,$name,$logInID,$userID) {
			try {
		$db->query("UPDATE `users` SET `name` = '{$name}', `loginid` = '{$logInID}' WHERE `id` = '{$userID}'");
			} catch (PDOException $e){ die($e->getMessage()); }
	}
	
	
	
	public static function resetPassword($db,$userID) {
		$password = crypt('password',CRYPT);
			try {
		$db->query("UPDATE `users` SET `password` = '{$password}' WHERE `id` = '{$userID}'");
			} catch (PDOException $e){ die($e->getMessage()); }
	}
	
	
	
	public static function deActivate($db,$userID) {
			try {
		$db->query("UPDATE `users` SET `active` = '1' WHERE `id` = '{$userID}'");
			} catch (PDOException $e){ die($e->getMessage()); }
	}
	
	
	
}