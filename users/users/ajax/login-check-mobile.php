<?php 
header("Access-Control-Allow-Origin:*");
include('../../includes/init.php');


//print_r($_POST);
$phone=$_POST['phone_L'];
//echo "SELECT `password`,COUNT('id') as 'number' FROM `users` WHERE `loginid` = '{$loginid}'";
try {
$query = $db->query("SELECT `password` FROM `users` WHERE `loginid` = '{$phone}' and `active`=0");
} catch (PDOException $e){ die($e->getMessage()); }

$row = $query->fetch(PDO::FETCH_ASSOC);
//echo '<br>'.$row['password'].'<br>';
if (password_verify($_POST['Password_L'], $row['password'])) {
    //echo 'Verified<br>';

	//echo 'correct';
	$row['number'] = 1;
} else {
     //$row['number'] = 55;
} 
//echo $row['number']."kakjhk";
 $allowed_userTypes=array("2","3","4");
 
 if($row['number'] == 1 ) {

 	$username=User::getName($db,$_POST['phone_L']);
 	$userType=User::getUserType($db,$_POST['phone_L']);
 	if (in_array($userType, $allowed_userTypes))
  	{
 		echo "success_".$username."_".$_POST['phone_L'];
		exit();
	}
	else
	{
		echo "User Not Allowed";
	    exit();
	}
}
else {
	//header("Location: ".HOST."/users/users/logout.php");
	echo "Password verification  Error";
	exit();
}

?>