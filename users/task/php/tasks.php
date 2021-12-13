<?php
include('../../includes/init.php');
if(isset($_POST['addTask'])) {
	//print_r($_POST); exit();
	$added_by=User::getUserIDwithLogInID($db,$_SESSION['logInID']);
	$added_on=date("Y-m-d H:i:s");
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
			if($stage=='3'){
				Task::updateCompletion($db,$_POST['taskID']);
				Email::notifyTaskComplete($db,$_POST['taskID']);
			}
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
if($_POST['assignTask']){
	//print_r($_POST);
	$taskID=$_POST['taskID'];
	$userID=$_POST['userID'];
	$assigned_on=date("Y-m-d H:i:s");
	$assigned_by=User::getUserIDwithLogInID($db,$_SESSION['logInID']);
	if(Task::updateAssign($db,$taskID,$userID)){

		if($userID!='')
		{
			TaskAssign::add($db,$taskID,$userID,$assigned_on,$assigned_by);
		}
		Email::notifyTaskAssign($db,$taskID);
		echo "Assigned";
	}
	else
	{
		echo "error";
	}
}
if($_POST['getTaskUpdates']){
	echo TaskUpdate::getList($db,$_POST['taskID']);
}
if($_POST['submitTaskUpdates']){
	//print_r($_FILES);print_r($_POST); exit();
	$taskID=$_POST['taskID'];
	$updates=$_POST['taskupdates'];
	$media_link=$_POST['mediafilelink'];
	if(isset($_FILES["media"]["name"])){
		//if(in_array($_FILES["recognition_cert"]["type"], $type_allowed)){
			$media_name = strtolower($_FILES["media"]["name"]);
	        $media_tmp = $_FILES["media"]['tmp_name'];
	        $ext  = explode('.',$media_name);// echo $product_image_name;
	        $ext = end($ext); 
	        if($media_name!=""){
	            $thisdoc=rand()."_media{$taskID}".".".$ext;
	            if(Image::uploadMedia($thisdoc,$media_tmp))
	            {
	                $media_doc=$thisdoc;//echo $thispdf;
	            }
	            else{
	               $media_doc="";
	            }
	            

	          }
    }
    else
    {
    	$media_doc="";
    }
    $added_by=User::getUserIDwithLogInID($db,$_SESSION['logInID']);
	$added_on=date("Y-m-d H:i:s");
	if(TaskUpdate::add($db,$taskID,$updates,$media_doc,$media_link,$added_on,$added_by)){
		echo "success";
	}
	else
	{
		echo "error";
	}
}

if($_POST['getSingleTaskUpdates']){
	//print_r($_POST);
	$noteData=TaskUpdate::getSingleTaskUpdates($db,$_POST['taskUpdateID']);
	$json=json_encode($noteData);
		echo $json;
}
if($_POST['deleteTaskUpdate']){
	//print_r($_POST);
	if(TaskUpdate::deactivate($db,$_POST['taskUpdateID'])){
		echo TaskUpdate::getList($db,$_POST['taskID']);
	}
	else
	{
		echo "error";
	}
	
}
if($_POST['editTaskUpdate']){
	//print_r($_FILES);
	//print_r($_POST); //exit();
	$rowID=$_POST['rowID'];
	$updates=$_POST['taskupdates'];
	$media_link=$_POST['mediafilelink'];
	if(isset($_FILES["media"]["name"])){
		//if(in_array($_FILES["recognition_cert"]["type"], $type_allowed)){
			$media_name = strtolower($_FILES["media"]["name"]);
	        $media_tmp = $_FILES["media"]['tmp_name'];
	        $ext  = explode('.',$media_name);// echo $product_image_name;
	        $ext = end($ext); 
	        if($media_name!=""){
	            $thisdoc=rand()."_media{$taskID}".".".$ext;
	            if(Image::uploadMedia($thisdoc,$media_tmp))
	            {
	                $media_doc=$thisdoc;//echo $thispdf;
	            }
	            else{
	               $media_doc=$_POST['media_current'];
	            }
	            

	        }
    }
    else
    {
    	$media_doc=$_POST['media_current'];
    }
    
    $updated_by=User::getUserIDwithLogInID($db,$_SESSION['logInID']);
	$updated_on=date("Y-m-d H:i:s");
	$taskID=$_POST['taskID'];
	if(TaskUpdate::update($db,$rowID,$updates,$media_doc,$media_link,$updated_on,$updated_by)){
		echo TaskUpdate::getList($db,$_POST['taskID']);
	}
	else
	{
		echo "error";
	}
}
if(isset($_POST['deleteMediaDoc'])) {


	if(Image::deleteMediaDoc($db,$_POST['img'],$_POST['rowID'],'media')){

	
		echo TaskUpdate::getList($db,$_POST['taskID']);
	}
	else
	{
		
		echo "error";
	}
	
}
?>
