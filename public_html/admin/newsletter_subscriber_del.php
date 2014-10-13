<?php 
	require "./includes/application_top.php";	
	require "./includes/email.php";

$admin_id=$_SESSION['admin_id'];
if ($admin_id==""){
	$msg="Session Expired. Please Login Again to Proceed.";
	$_SESSION['msg']=$msg;
	header("Location:index.php");
	exit();
}


$arr_ids		= $_POST['ids'];
$start			= $_POST['start'];
$newsletter_id  = $_POST['newsletter_id'];

if(count($arr_ids)>0){
	$str_ids=implode("','",$arr_ids);

	if($_POST['Delete']!=''){
		$sql="delete from yp_newsletter_subscriber where id in ('$str_ids') " ;
		executeUpdate($sql);
		$sess_msg="RECORD DELETED SUCCESSFULLY.";
		$_SESSION['sess_msg'] = $sess_msg;
		header("Location: newsletter_subscriber_list.php");
		exit();
	}	

	if($_POST['Send']!=''){
			if($newsletter_id==''){
			$sess_msg="PLEASE SELECT NEWSLETTER TO SEND.";
			$_SESSION['sess_msg'] = $sess_msg;
			header("Location: newsletter_subscriber_list.php");
			exit();
			}

		foreach ($arr_ids as $id){
			$to='';
			$sql = "select emailid from yp_newsletter_subscriber where id='$id' and status='Active' ";
			$to  = getsingleresult($sql);

			$sql_n = "select * from yp_newsletter where newsletter_status='Active' ";
			if($newsletter_id!=''){
				$sql_n.=" and newsletter_id='$newsletter_id'";
			}
			$result=executeQuery($sql_n);

			while($line=mysql_fetch_array($result)){
				$newsletter_subject		= $line['newsletter_subject'];
				$newsletter_graphics	= $line['newsletter_graphics'];
				$newsletter_text		= $line['newsletter_text'];

				$newsletter_graphics = str_replace("/uploadedfiles", $non_secure_path."uploadedfiles", $newsletter_graphics);

		$subject = $newsletter_subject;

		$message="<html>
					<head>
					<title>$site_title</title>
					<meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1'>
					</head>

					<body leftmargin='0' topmargin='0' marginwidth='0' marginheight='0'>
					<table width='780'  border='0' align='center' cellpadding='0' cellspacing='0'>
					  <tr>
						<td><table width='100%' border='0' align='center' cellpadding='1' cellspacing='0' bgcolor='e4e4e4'>
						  <tr>        
							  <td>
								<table width='100%' border='0' bgcolor='#FFFFFF' cellpadding='2' cellspacing='2'>
								  <tr>
									<td colspan='2' align='left'>
										<img src='".$non_secure_path."images/logo.png' border='0' />
									</td>
									</tr>
								  <tr>
									<td width='1%'>&nbsp;</td>
									<td width='99%' align='center'></td>
								  </tr>
								  <tr>
									<td width='1%'>&nbsp;</td>
									<td width='99%'></td>
								  </tr>
								  <tr>
									<td width='1%'>&nbsp;</td>
									<td width='99%'>".stripslashes($newsletter_graphics)."</td>
								  </tr>
								  <tr>
									<td width='1%'>&nbsp;</td>
									<td width='99%'></td>
								  </tr>
								  <tr>
									<td width='1%'>&nbsp;</td>
									<td width='99%'>".stripslashes($newsletter_text)."</td>
								  </tr>	
								 <tr>
									<td width='1%'>&nbsp;</td>
									<td width='99%'></td>
								  </tr>
								 <tr>
									<td width='1%'>&nbsp;</td>
									<td width='99%'>If you wish to Unsubscribe from the Mailing List, please click <a href='".$non_secure_path."newsletter_unsubscribe_frm.php' target='_blank'>HERE</a></td>
								  </tr>

							  </table></td>
						  </tr>
						</table></td>
					  </tr>
					</table>";

			$headers  = "MIME-Version: 1.0\r\n";
			$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";

			$headers .= "From: ".$site_email." \r\n";
			//echo "To: $to <br> Headers: $headers <br> Subject: $subject <br> Message $message";
			//exit;
			@mail($to, $subject, $message, $headers);
			}
		}
		//exit;
		header("Location: newsletter_send_thanks.php?id=$newsletter_id");
		exit;
	}

	if($_POST['Active']!=''){
		$sql="update yp_newsletter_subscriber set status='Active' where id in ('$str_ids') ";
		executeUpdate($sql);
	}

	if($_POST['Inactive']!=''){
		$sql="update yp_newsletter_subscriber set status='Inactive' where id in ('$str_ids') ";	
		executeUpdate($sql);
	}
	
	if($_POST['Unsubscribe']!=''){
		$sql="update yp_newsletter_subscriber set status='Unsubscribed' where id in ('$str_ids') ";	
		executeUpdate($sql);
	}
}else{
	$sess_msg="PLEASE SELECT AT LEAST ONE RECORD.";
	$_SESSION['sess_msg'] = $sess_msg;
}
header("location: newsletter_subscriber_list.php");
exit();
?>