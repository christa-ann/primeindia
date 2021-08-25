<?php 
header("Access-Control-Allow-Origin:*");
include('../includes/init.php');


//print_r($_POST);
$loginid=$_POST['email'];
//echo "SELECT `password`,COUNT('id') as 'number' FROM `users` WHERE `loginid` = '{$loginid}'";
try {
$query = $db->query("SELECT `password` FROM `users` WHERE `loginid` = '{$loginid}'");
} catch (PDOException $e){ die($e->getMessage()); }

$row = $query->fetch(PDO::FETCH_ASSOC);
//echo '<br>'.$row['password'].'<br>';
if (password_verify($_POST['password'], $row['password'])) {
    //echo 'Verified<br>';

	//echo 'correct';
	$row['number'] = 1;
} else {
     //$row['number'] = 55;
} 
//echo $row['number']."kakjhk";
 
 
 if($row['number'] == 1 ) {
	if(User::checkUserVerifiedActive($db,$_POST['email']) ) {
		$_SESSION['loggedIn'] = 1;
		$_SESSION['logInID'] = $_POST['email'];
		$_SESSION['userID'] = User::getUserIDwithLogInID($db,$_POST['email']);
		//$_SESSION['entityID'] = User::getEntityID($db,$_POST['logInID']); && Entity::checkEntityVerifiedActive($db,$_POST['logInID'])
		//header("Location: ".HOST."/users/welcome.php");
		//print_r(json_decode($_SESSION));
		$data=User::getName($db,$_POST['email'])."--".User::getUserIDwithLogInID($db,$_POST['email'])."--".User:: getUserType($db,$_POST['email']);
		//Notification::sendNotification($db,"christaannphilip@gmail.com","Welcome","Greeting From Sattva");
		echo $data;

		exit();
	} else {
		//header("Location: ".HOST."/users/users/logout.php");
		echo "error";
		exit();
	}
}
else {
	//header("Location: ".HOST."/users/users/logout.php");
	echo "error";
	exit();
}

?>