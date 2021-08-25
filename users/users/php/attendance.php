<?php include('../../includes/init.php');
//print_r($_POST);
if (isset($_POST['emp_attend'])) {
	//print_r($_POST);
	echo Attendance::empAttendance($db,$_POST['daterange']);
}

if (isset($_POST['myattend'])) {
	//print_r($_POST);
	echo Attendance::myAttendance($db,$userID,$_POST['daterange']);
}
if (isset($_POST['user_attend_track'])) {
	//print_r($_POST);
	echo Attendance::userAttendanceDetail($db,$_POST['userid']);
}
?>