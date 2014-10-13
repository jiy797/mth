<?php
	require "./includes/application_top.php";

	$uns_email = checkInput($_POST['uns_email']);

	//--------------------------------------------------------------------------------------------------
		if(empty($uns_email)){
			$_SESSION['sess_msg']="PLEASE FILL ALL THE REQUIRED FIELDS.";
			header("Location: newsletter_unsubscribe_frm.php");
			exit();
		}
	//--------------------------------------------------------------------------------------------------

	$sql="select * from yp_newsletter_subscriber where emailid='$uns_email'";
	$result= executequery($sql);

	if($line= mysql_fetch_array($result)){
		$sql_uv="update yp_newsletter_subscriber set status='Unsubscribed' where emailid='$uns_email'";
		executequery($sql_uv);
		$_SESSION['sess_msg']="THIS ID HAS BEEN UNSUBSCRIBED FROM MAILING LIST.";
	}else{
		$_SESSION['sess_msg']="NO SUCH EMAIL ID EXISTS IN OUR SYSTEM.";
	}
	header("Location: newsletter_unsubscribe_frm.php");
	exit();
?>
