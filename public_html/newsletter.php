<?php
	require "./includes/application_top.php";

	$subs_name = valid_data(str_replace("''","'",checkInput($_POST["subs_name"])));
	$emailid   = checkInput($_POST["n_email"]);

	$_SESSION['subs_name'] = $subs_name;
	
	if($emailid==''){
		$sess_msg="PLEASE FILL ALL THE REQUIRED FIELDS.";
		$_SESSION['sess_msg'] = $sess_msg;
		header("location: newsletter_frm.php");
		exit;
	}

	if (!(ereg ("^.+@.+\..+$", $emailid))){
		$sess_msg="PLEASE FILL ALL THE REQUIRED FIELDS.";
		$_SESSION['sess_msg'] = $sess_msg;
		header("location: newsletter_frm.php");
		exit;		
    }

	$sql="select id from yp_newsletter_subscriber where emailid='$emailid'";
	$res= getSingleResult($sql);

	if($res!=""){
		$sess_msg=	"THIS EMAIL ADDRESS ALREADY EXISTS. <br>PLEASE SUBMIT ANY OTHER EMAIL ADDRESS."; // Message for Email Exists.
		$_SESSION['sess_msg'] = $sess_msg;
		header("location: newsletter_frm.php");
		exit;
	}else{
		$sql="insert into yp_newsletter_subscriber (tdate, subs_name, emailid, status) values(now(), '$subs_name', '$emailid', 'Inactive')";
		executeQuery($sql);

		//---------Send Email to Owner-------------------

		$headers  = "MIME-Version: 1.0\r\n";
		$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
		$headers .= "From: ".$site_from." \r\n";

		$to = $site_email;

		$subject="New Member Added";
		$message="A new member has been added to your Newsletter List on ".$site_address."<br><br>";


		@mail($to, $subject, $message, $headers);
		//-------------------------------------------------

		//---------Send Email to User----------------------
		
		
		$veri_code = verification_code();
		$email_status="Pending";

		$sql_tl="update yp_newsletter_subscriber set verification_code='$veri_code', email_status='$email_status' where emailid='$emailid'";
		executeUpdate($sql_tl);

		$headers= "MIME-Version: 1.0\r\n";
		$headers.= "Content-type: text/html; charset=iso-8859-1\r\n";
		$headers.= "From: ".$site_from." \r\n";

		$to = $emailid;
		$subject = "Message from ".$site_address;
		
		/*
		$message="<html><body>Hello ".stripslashes($subs_name).",<br><br>";
		$message.="This is a verification email from ".$site_address.".<br><br>Following is your verification code:<br><br>";
		$message.="Verification Code : ".$veri_code."<br><br>";
		$message.="Please login with this code to make your 'Newsletter List' status active on our site.<br><br>";
		$message.="Please copy the following link in the browser to verify:<br>";
		$message.=$non_secure_path."newsletter_verify_frm.php<br><br>";
		$message.="Thanks,<br><br>Admin<br><a href='http://".$site_address."'>".$site_address."</a></html></body>";
		*/

		$message="<html><body>Hello ".stripslashes($subs_name).",<br><br>";
		$message.="Thank you for subscribing for our newsletter at ".$site_address.".<br><br>";
		$message.="This is a verification email from ".$site_address.".<br><br>Following is your verification code:<br><br>";
		$message.="Verification Code : ".$veri_code."<br><br>";
		$message.="Please copy/paste the following link in the browser to verify your details:<br><br>";
		$message.=$non_secure_path."newsletter_check.php?em=".$emailid."&vr=".$veri_code."<br><br>";
		$message.="Thanks,<br><br>Admin<br><a href='http://".$site_address."'>".$site_address."</a></html></body>";

		@mail($to, $subject, $message, $headers);
		

		unset($_SESSION['subs_name']);

		//---------------------------------------------------

		header("location: newsletter_thanks.php");
		exit;
	}
?>