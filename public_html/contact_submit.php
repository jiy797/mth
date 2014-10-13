<?php 
	require "./includes/application_top.php";

	$first_name		= valid_data(str_replace("''","'",checkInput($_POST['first_name'])));
	$last_name		= valid_data(str_replace("''","'",checkInput($_POST['last_name'])));
	$company		= valid_data(str_replace("''","'",checkInput($_POST['company'])));
	$phone1			= valid_data(str_replace("''","'",checkInput($_POST['phone1'])));
	$phone2			= valid_data(str_replace("''","'",checkInput($_POST['phone2'])));
	$phone3			= valid_data(str_replace("''","'",checkInput($_POST['phone3'])));
	$email_address	= valid_data(str_replace("''","'",checkInput($_POST['email_address'])));
	$comments		= valid_data(str_replace("''","'",checkInput($_POST['comments'])));
	$e_subject		= valid_data(str_replace("''","'",checkInput($_POST['e_subject'])));

	$_SESSION['first_name']		= $first_name;
	$_SESSION['last_name']		= $last_name;
	$_SESSION['company']		= $company;
	$_SESSION['phone1']			= $phone1;
	$_SESSION['phone2']			= $phone2;
	$_SESSION['phone3']			= $phone3;
	$_SESSION['email_address']	= $email_address;
	$_SESSION['comments']		= $comments;
	$_SESSION['e_subject']		= $e_subject;

	if(empty($first_name) || empty($last_name) || empty($email_address) || empty($comments) || $e_subject=='0'){
		$_SESSION['sess_msg']="PLEASE FILL ALL THE REQUIRED FIELDS";
		header("Location: contact.php");
		exit();
	}

	if (!(ereg ("^.+@.+\..+$", $email_address))){
		$_SESSION['sess_msg']="EMAIL VALUE IS INVALID. PLEASE FILL A CORRECT VALUE. "; 
		header("Location: contact.php");
		exit();
    }

if($email_address!=''){
	//----------------- Send Email To Owner-------------------------------------------------------------------------

	$headers  = "MIME-Version: 1.0\r\n";
	$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
	$headers .= "From: ".$site_email." \r\n";

	$to=$site_email;

	$subject="New Contact Us Message From Site";

	$message="<table>";
	$message.="<tr><td valign='top'><b>Name </td><td valign='top'>".stripslashes($first_name)." ".stripslashes($last_name)." </td></tr>";
	if($company!=''){
		$message.="<tr><td valign='top'><b>Company</td><td valign='top'>".stripslashes($company)."</td></tr>";
	}
	if($phone1!=''&&$phone2!=''&&$phone3!=''){
		$message.="<tr><td valign='top'><b>Phone</td><td valign='top'>".stripslashes($phone1.'-'.$phone2.'-'.$phone3)."</td></tr>";
	}
	$message.="<tr><td valign='top'><b>Email Address </td><td valign='top'>".stripslashes($email_address)."</td></tr>";
	$message.="<tr><td valign='top'><b>Subject </td><td valign='top'>".stripslashes($e_subject)."</td></tr>";
	$message.="<tr><td valign='top'><b>Message </td><td valign='top'>".nl2br(stripslashes($comments))."</td></tr>";
	$message.="</table>";
	
	@mail($to, $subject, $message, $headers);
	//------------------------------------------------------------------------------------------------------------------

	unset($_SESSION['first_name']);
	unset($_SESSION['last_name']);
	unset($_SESSION['company']);
	unset($_SESSION['phone1']);
	unset($_SESSION['phone2']);
	unset($_SESSION['phone3']);
	unset($_SESSION['email_address']);
	unset($_SESSION['comments']);	
	unset($_SESSION['e_subject']);	

	//$_SESSION['sess_msg']="THANK YOU FOR YOUR MESSAGE.";
	header("Location: contact_thanks.php");
	exit();
}else{
	$_SESSION['sess_msg']="PLEASE FILL ALL THE REQUIRED FIELDS";
	header("Location: contact.php");
	exit();
}
?>
