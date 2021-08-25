<?php include('../includes/init.php');

//$password = crypt($_POST['password'],CRYPT);
//echo "SELECT COUNT('id') as 'number' FROM `users` WHERE `loginid` = :loginid AND `password` = :password";exit();
//print_r($_POST);
 $loginid=$_POST['logInID'];

 try {
$query = $db->query("SELECT `password`,COUNT('id') as 'number' FROM `users` WHERE `loginid` = '{$loginid}' ");
} catch (PDOException $e){ die($e->getMessage()); }

$row = $query->fetch(PDO::FETCH_ASSOC);
if (password_verify($_POST['password'], $row['password'])) {
    //echo 'Verified<br>';
	 $row['number'] = 1;
} else {
    $row['number'] = 55;
} 


//echo "SELECT COUNT('id') as 'number' FROM `users` WHERE `loginid` = '{$loginid}' AND `password` = '{$password}'";exit();
 if($row['number'] == 1 ) {
 	//$allowed_userTypes=array("2","3","4");
 	// if($row['user_type_id']==2){
 	// 		$_SESSION['logInMessage']="<p  style=\"color:red;\">Access Denied.</p>";
		// 	header("Location: ".HOST."/index.php");
		// 	exit();
 	// }
 	// else
 	// {
	 	if(User::checkUserVerifiedActive($db,$_POST['logInID']) ) {
			$_SESSION['loggedIn'] = 1;
			$_SESSION['logInID'] = $_POST['logInID'];
			$_SESSION['userID'] = User::getUserIDwithLogInID($db,$_POST['logInID']);
			if(!empty($_POST["remember"])) {

				setcookie ("uname_cookie",$_POST["logInID"],time()+(10 * 365 * 24 * 60 * 60),'/');
				setcookie ("password_cookie",$_POST["password"],time()+(10 * 365 * 24 * 60 * 60),'/'); 
				//print_r($_COOKIE);
				//echo "Cookies Set Successfuly";exit();
				header("Location: ".HOST."/users/welcome.php");
				
			} else {
				setcookie("username","");
				setcookie("password","");
				//echo "Cookies Not Set";
				header("Location: ".HOST."/users/users/logout.php");
				exit();
			} 
			//$_SESSION['entityID'] = User::getEntityID($db,$_POST['logInID']); && Entity::checkEntityVerifiedActive($db,$_POST['logInID'])
			// header("Location: ".HOST."/users/welcome.php");
			// exit();

		} else {
			$_SESSION['logInMessage']="<p  style=\"color:red;\">User not active</p>";
			header("Location: ".HOST."/index.php");
			exit();
		}
 	//}
	
}
else {
	//$msg=($row['user_type_id']==2)?"(Access Denied)":"";
	$_SESSION['logInMessage']="<p  style=\"color:red;\">Invalid Credentials {$msg}.</p>";

	header("Location: ".HOST."/index.php");
	exit();
}

?>