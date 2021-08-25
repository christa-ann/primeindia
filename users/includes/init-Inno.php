<?php
session_start();

//getting root and host values for database table = init
	//echo __DIR__.'<br>';							//root
	//echo 'http://'.$_SERVER['HTTP_HOST'].'<br>';	//host
	
//error reporting
	error_reporting(0);

//defining various constants
	define("CRYPT", 'hello_CARAMA*123', true);

//database connection LOCALHOST
	$dbhost     = "localhost";
	$dbname     = "rejola_sales_database";
	$dbuser     = "rejola_sales_use";
	$dbpass     = "Sales@1234";
	
	$db = new PDO("mysql:host=$dbhost;dbname=$dbname",$dbuser,$dbpass);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


//extract Root and Host
		try {
	$query = $db->query("SELECT * FROM `init` WHERE `name` = 'root' OR `name` = 'host'");
		} catch (PDOException $e){ die($e->getMessage()); }
	while($row = $query->fetch(PDO::FETCH_ASSOC)) {
		if($row['name'] == 'root') {
			define("ROOT", $row['value'], true);
		} else {
			define("HOST", $row['value'], true);
		}
	}	

//loading the CLASSES
	function __autoload($className) {
		include(ROOT.'/users/objects/'.$className.'.php');
	}

//setting to Indian time
	date_default_timezone_set("Asia/Kolkata");


//including PHP Mailer
	//include($_SESSION['root'].'/users/PHPMailer/class.phpmailer.php');

//user activity record
	/* if($_SESSION['loggedIn'] == 1) {
		UserActivity::recordActivity($db,$_SESSION['userID'],basename($_SERVER['PHP_SELF']));
	} */
	if(isset($_SESSION['userID'])) {
		$userID = $_SESSION['userID'];
	} else {
		$userID = $_GET['check'];
	}
	UserActivity::recordActivity($db,$userID,basename($_SERVER['PHP_SELF']));

	
?>