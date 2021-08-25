<?php 
class Email {
	
	public static function sendEmailID() {
		//return 'thomas@BusinessSuccessPartner.com';		//future bspzone.com ??
		return 'thomas@rejola.com';
	}
	
	
	public static function sendEmailName() {
		return 'Dyadni Team';
	}
	
	public static function sendEmailPassword() {
		//return 'BSP@123';'lv@f6o?wONpu'
		//return 'jadmin_1234';
		return 'lv@f6o?wONpu';
	}
	
	
	public static function sendEmailSignature() {
		return "
					<p>
						Thank you and regards,<br>
						Dyadni Team
						
					</p>
				";
	}
	
	
	
	public function content() {
		//build the subject and the intro and main message
		
		//return array
				
	}
	
	
	public static function sendEmail($toEmail,$subject,$message,$attachment){
		date_default_timezone_set('Asia/Calcutta');
		require_once(ROOT.'/PHPMailer/class.phpmailer.php');
		
		//Create a new PHPMailer instance
		$mail = new PHPMailer();
		//Tell PHPMailer to use SMTP
		$mail->IsSMTP();
		//Enable SMTP debugging
		// 0 = off (for production use)
		// 1 = client messages
		// 2 = client and server messages
		$mail->SMTPDebug  = 0;
		//Ask for HTML-friendly debug output
		$mail->Debugoutput = 'html';
		//Set the hostname of the mail server
		//$mail->Host       = 'mail.nandita.co';
		$mail->Host       = 'server109.verygoodserver.com';
		//$mail->Host       = 'mail.digidreamsindia.com/mail.justbuycycles.in';
		//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
		$mail->Port       = 465;
		//Whether to use SMTP authentication
		$mail->SMTPAuth   = true;
		$mail->SMTPSecure = "ssl";

		//Username to use for SMTP authentication - use full email address for gmail
		$mail->Username   = self::sendEmailID();
		//Password to use for SMTP authentication
		$mail->Password   = self::sendEmailPassword();
		//Set who the message is to be sent from
		$mail->SetFrom(self::sendEmailID(), self::sendEmailName());
		//Set an alternative reply-to address
		$mail->AddReplyTo(self::sendEmailID(), self::sendEmailName());
		//Set who the message is to be sent to
		//$mail->AddAddress($to);
		//$mail->AddBCC($tobcc);
		
		//checking if there are multiple email ids ; that is if it has =>
		if (strpos($toEmail,'=>') !== false) {
			//then has multiple email ids
			$a = explode('=>',$toEmail);
			foreach($a as $email) {
				$mail->AddAddress($email);
			}
		} else {
			$mail->AddAddress($toEmail);
		}
		
		//if($_POST[bcc1]) {$mail->AddBCC($_POST[bcc1]);}
		//if($_POST[bcc2]) {$mail->AddBCC($_POST[bcc2]);}
		
		//Set the subject line
		$mail->Subject = $subject;
		//Read an HTML message body from an external file, convert referenced images to embedded, convert HTML into a basic plain-text alternative body
		$mail->MsgHTML($message);
		//Replace the plain text body with one created manually
		//$mail->AltBody = 'This is a plain-text message body';
		//Attach an image file
		if(strlen($attachment) > 0) {
			$mail->AddAttachment($attachment);
		}
		
		
		if($mail->Send())
			return true;
		else
			return $mail->ErrorInfo;
	}
	
	
	
	
	public static function newMemberEmail($email,$securityString) {
		$subject = " Dyadni: New Member";
		$signature = self::sendEmailSignature();
		$message = "
						<html>
							<head><title>New Member</title></head>
							<body style=\"font-family:Verdana;\">
								<h1>Welcome!</h1>
								<p>Please click the link below to verify your account and create your account password.</p>
								<p><a href=\"".HOST."/new-member-password.php?security={$securityString}\">".HOST."/new-member-password.php?security={$securityString}</a></p>
								<p>If the link is not working, please copy and paste the same in your browser and try again.</p>
								<p>Please feel free to contact us for any further assistance.</p>
								{$signature}								
							</body>
						</html>
					";
					//echo $message;
					self::sendEmail($email,$subject,$message,'');
		// if()
		// {
		// 	echo "send";
		// 	return true;
		// }
		// else
		// {
		// 	echo "error";
		// 	return false;
		// }

	}
	
	public static function resetPasswordEmail($email,$securityString) {
		$subject = "Kaiyaan Customer : Reset Your Password";
		$signature = self::sendEmailSignature();
		$message = "
						<html>
							<head><title>Reset Password</title></head>
							<body style=\"font-family:Verdana;\">
								<h1>Welcome!</h1>
								<p>Please click the link below to verify your account and create your account password.</p>
								<p><a href=\"".HOST."/reset-password.php?security={$securityString}\">".HOST."/reset-password.php?security={$securityString}</a></p>
								<p>If the link is not working, please copy and paste the same in your browser and try again.</p>
								<p>Please feel free to contact us for any further assistance.</p>
								{$signature}								
							</body>
						</html>
					";
					//echo $email."email";
		if(self::sendEmail($email,$subject,$message,''))
		{

			return true;
		}
		else
		{
			echo "Not send";
			return false;
		}
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
}
?>