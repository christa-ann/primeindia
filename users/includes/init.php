<?php

session_start();



//getting root and host values for database table = init

	// echo __DIR__.'<br>';							//root

	// echo 'http://'.$_SERVER['HTTP_HOST'].'<br>';	//host

	

//error reporting

	error_reporting(1);



//defining various constants

	define("CRYPT", 'hello_CARAMA*123', true);



// //database connection LOCALHOST

	// $dbhost     = "localhost";

	// $dbname     = "primeindia";

	// $dbuser     = "root";

	// $dbpass     = "";

	//database connection LOCALHOST

	$dbhost     = "localhost";

	$dbname     = "rejola_primeindia";

	$dbuser     = "rejola_piadmin";

	$dbpass     = "rejola_pipass";

	

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

	// function __autoload($className) {

	// 	include(ROOT.'/users/objects/'.$className.'.php');

	// }
function my_autoloader($className) {

		include(ROOT.'/users/objects/'.$className.'.php');

	}
spl_autoload_register('my_autoloader');


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