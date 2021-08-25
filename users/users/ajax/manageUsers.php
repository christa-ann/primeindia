<?php 
header("Access-Control-Allow-Origin:*");
include('../../includes/init.php');
//This page is f handlding Customers

// if(isset($_POST['reg_otp'])){
// 	// echo"hai";
// 	//check user exists;
	

// 	if(Customer::checkCustomerExists($db,$_POST['phone1'])){
// 		if(Customer::getStatus($db,$_POST['phone1'])==1){
// 			if(Customer::deletePartialCustomer($db,$_POST['phone1'])){

// 				$otp = rand(100000,999999); //echo $otp;
// 				$status=1;//echo "success";
// 				//print_r($_POST);
// 				$joindate=date("Y-m-d");
// 				if(Customer::addCustomer($db,$_POST['Username'],$_POST['phone1'],$_POST['Password_R'],$joindate,$otp,$status,$_POST['Email']))
// 				{
// 					echo "success";
// 				}
// 				else
// 				{
// 					echo "OTP Not sent successfully";
// 				}

// 			}
// 			else
// 			{
// 				echo "Partially Registered Customer";
// 			}
// 		}
// 		else{
// 			echo "Already Registered";
// 		}
		
// 	}
// 	else
// 	{
// 			// generate OTP
// 			$otp = rand(100000,999999); //echo $otp;
// 			$status=1;//echo "success";
// 			//print_r($_POST);
// 			$joindate=date("Y-m-d");
// 			if(Customer::addCustomer($db,$_POST['Username'],$_POST['phone1'],$_POST['Password_R'],$joindate,$otp,$status,$_POST['Email']))
// 			{
// 				echo "success";
// 			}
// 			else
// 			{
// 				echo "OTP Not sent successfully";
// 			}
			

// 	}
// }
// if(isset($_POST['login_otp'])){
// 	//print_r($_POST); echo"hai";
// 	//check user exists;
	

// 	if(Customer::checkCustomerExists($db,$_POST['phone'])){
// 		//echo "Customer exists";
// 			// generate OTP
// 			$otp = rand(100000,999999); //echo $otp;
// 			if(Customer::updateOTP($db,$_POST['phone'],$otp))
// 			{
// 				echo "success";
// 			}
// 			else
// 			{
// 				echo "OTP Not sent successfully. Please Try again";
// 			}
// 	}
// 	else
// 	{
// 		echo "Customer not registered";
	
// 	}
// }
//
// if(isset($_POST['submit_otp'])){
// 	//print_r($_POST);
// 	if(Customer::verifyOTP($db,$_POST['phone'],$_POST['otp']))
// 	{
		
// 		if(Customer::activateCustomer($db,$_POST['phone']))
// 		{
// 			echo "success";
// 		}
// 		else
// 		{
// 			echo "Customer not activated";
// 		}
// 	}
// 	else
// 	{
		
// 		//Delete CustomerCOde 
// 		Customer::deleteCustomer($db,$_POST['phone']);echo "OTP Not Verified";
// 	}
// }
// if(isset($_POST['submit_otp_login'])){
// 	//print_r($_POST);
// 	if(Customer::verifyOTP($db,$_POST['phone2'],$_POST['otp']))
// 	{
// 		$username=Customer::getUsername($db,$_POST['phone2']);
// 		echo "success_".$username."_".$_POST['phone2'];
		
// 	}
// 	else
// 	{
// 		echo "OTP Not Verified";
// 		//Update that Otp field to null - code to be written
// 	}
// }
if(isset($_POST['updatePassword'])){
	//print_r($_POST); 
	
	if(!(strlen($_POST['newpassword'])>=4))
	{
		echo "<p style=\"color:red;\">Password should have minimum 4 characters. Please try again</p>";
	}
	else if(!password_verify($_POST['password'], User::getPassword($db,$_POST['phone'])))
	{
		
		echo "<p style=\"color:red;\">Old Password entered is Incorrect. Please try again</p>";
	}
	else if($_POST['newpassword']!=$_POST['confirmnewpassword'])
	{
		echo "<p style=\"color:red;\">New Passwords does not match. Please try again</p>";
	}
	else
	{
		if(User::changePassword($db,$_POST['phone'],$_POST['newpassword']))
			{
				
				echo "<p style=\"color:green;\">Successfully Updated</p>";
				
			}
			else
			{
				echo "<p style=\"color:red;\">Password Could'nt be updated.  Please try again.</p>";
				//Update that Otp field to null - code to be written
			}
	}
	exit();
}
if(isset($_POST['submitforgot'])){
	//print_r($_POST);
	//echo "inside if";
	//check if email is present and is active
	if(Customer::checkCustomerExists2($db,$_POST['Email_F'])) {		//can be 1 or 2
		 $customerID = Customer::getID($db,$_POST['Email_F']); //echo $customerID;
		 $securityString = Security::generateNewSecurity($customerID); //echo $securityString;
		 Security::insertSecurity($db,$customerID,$securityString);
		 if(Email::resetPasswordEmail($_POST['Email_F'],$securityString)){

		 	echo "<p>Please check your email inbox and follow the instructions to reset your password.</p>";

		 }else
		 {
		 	echo "<p style=\"color:green;\">Verifiation Mail Not Sent. Please contact Admin. </p>";
		 }
		 
		// header("Location: ".HOST."/new-member1.php");
		// exit();
	} else {
		echo "<p style=\"color:red;\">Sorry.  Your account is not active. </p>";
		// header("Location: ".HOST."/new-member.php");
		// exit();
	}
	//create security string
	//save security string
	//email security string
	
	//else mention that email id is not active, please contact thomas@rejola.com
	exit();
}
?>