<?php include('../../includes/init.php');

if(isset($_POST['addUserType'])) {
	//checking length to be minimum of 4 characters
	if(strlen($_POST['name']) >= 2) {
			UserType::addUserType($db,$_POST['name']);
			$_SESSION['addItemMessage'] = "<h5 style=\"color:green;\">User Type has been added.</h5>";
	} else {
		$_SESSION['addItemMessage'] = "<h5 style=\"color:red;\">Name must have minimum 2 characters.</h5>";
	}
	header("Location: ../manage-usertype.php");
	exit();
}


if(isset($_POST['usertypeEditSave'])) {
	//checking length to be minimum of 4 characters
	if(strlen($_POST['name']) >= 2) {
			//add site
			UserType::editUserType($db,$_POST['name'],$_POST['usertypeID']);
			$_SESSION['editItemMessage'] = "<h5 style=\"color:green;\">UserType Edit Complete.</h5>";
	} else {
		$_SESSION['editItemMessage'] = "<h5 style=\"color:red;\">Name must have to have minimum 2 characters.</h5>";
	}
	header("Location: ../manage-usertype.php");
	exit();
}






