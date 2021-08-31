<?php
include('../../includes/init.php');
if(isset($_POST['addTask'])) {
	//print_r($_POST); exit();
	$added_by=User::getUserIDwithLogInID($db,$_SESSION['logInID']);
	$added_on=date("Y-m-d");
	$name=$_POST['name'];
	$description=$_POST['description'];
	$tat=$_POST['tat'];
	$assign_to=$_POST['assign_to'];
	//checking length to be minimum of 4 characters
	if(strlen($_POST['name']) >= 4) {
		//checking if log in id already exists
		if(Task::add($db,$name,$description,$tat,$added_on,$added_by,'1')) {
			//add task
			
			$_SESSION['addUserMessage'] = "<h5 style=\"color:green;\">Task Added.</h5>";
			header("Location: ../manage-tasks.php");
		} else {
			$_SESSION['addUserMessage'] = "<h5 style=\"color:red;\">Please contact Admin</h5>";
			header("Location: ../add-task.php");
		}
	} else {
		$_SESSION['addUserMessage'] = "<h5 style=\"color:red;\">Name and Log In ID have to have minimum 4 characters.</h5>";
		header("Location: ../add-task.php");

	}
	//header("Location: ../manage-users.php");
	exit();
}
if(isset($_POST['updateTask'])) {
	//print_r($_POST); exit();
	$updated_by=User::getUserIDwithLogInID($db,$_SESSION['logInID']);
	$updated_on=date("Y-m-d");
	$name=$_POST['name'];
	$description=$_POST['description'];
	$tat=$_POST['tat'];
	//$assign_to=$_POST['assign_to'];
	$stage=$_POST['stage'];
	//checking length to be minimum of 4 characters
	if(strlen($_POST['name']) >= 4) {
		//checking if log in id already exists
		if(Task::update($db,$name,$description,$tat,$stage,$updated_by,$updated_on,$_POST['taskID'])) {
			//add task
			
			$_SESSION['addUserMessage'] = "<h5 style=\"color:green;\">Task Updated.</h5>";
			header("Location: ../edit-task.php?temp={$_POST['taskID']}");
		} else {
			$_SESSION['addUserMessage'] = "<h5 style=\"color:red;\">Please contact Admin</h5>";
			header("Location: ../edit-task.php?temp={$_POST['taskID']}");
		}
	} else {
		$_SESSION['addUserMessage'] = "<h5 style=\"color:red;\">Name and Log In ID have to have minimum 4 characters.</h5>";
		header("Location: ../edit-task.php?temp={$_POST['taskID']}");

	}
	//header("Location: ../manage-users.php");
	exit();
}
if($_POST['deleteTask']){
	//print_r($_POST);
	if(Task::deactivate($db,$_POST['rowID'])){
		echo "Deleted";
	}
	else
	{
		echo "error";
	}
}
?>