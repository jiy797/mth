<?php
	require "./includes/application_top.php";

	$email		= checkInput($_POST['email']);
	$veri_code	= checkInput($_POST['veri_code']);

	$_SESSION['email'] = $set;
	$_SESSION['veri_code'] = $set;

	//--------------------------------------------------------------------------------------------------
		if(empty($email) || empty($veri_code)){
			$_SESSION['sess_msg'] = "PLEASE FILL ALL THE REQUIRED FIELDS.";
			header("Location: newsletter_verify_frm.php");
			exit();
		}
	//--------------------------------------------------------------------------------------------------

	$sql="select * from yp_newsletter_subscriber where emailid='$email'";
	$result= executequery($sql);

	if($line= mysql_fetch_array($result)){
		$email_status=$line['email_status'];


			if($email_status=="Pending"){
				$verification_code=$line['verification_code'];

				if($veri_code==$verification_code){
					$sql_uv="update yp_newsletter_subscriber set email_status='Confirmed', status='Active' where emailid='$email'";
					executequery($sql_uv);

					unset($_SESSION['email']);
					unset($_SESSION['veri_code']);

					$_SESSION['sess_msg']="YOUR STATUS HAS BEEN ACTIVATED.";

				}else{
					$_SESSION['sess_msg']="VERIFICATION CODE DOES NOT MATCH. <br>PLEASE FILL A CORRECT VALUE.";
				}
			}else{
				$_SESSION['sess_msg']="YOUR STATUS IS ALREADY ACTIVATED.";
			}
	}else{
		$_SESSION['sess_msg']="NO SUCH EMAIL ID EXISTS IN OUR SYSTEM.";
	}



	header("Location: newsletter_verify_frm.php");
	exit();
?>
