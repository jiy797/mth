<?php
	include "./includes/application_top.php";

	$email_from = $_POST['from_email'];
	$email_to	= $_POST['to_email'];
	$message1	= $_POST['message1'];

	$subject		= $email_from." has sent you a link";
	$link_to_send	= "<a href='".$site_address."'>".$site_address."</a>";

	if($email_to!="" && $email_from!=""){
		$headers  = "MIME-Version: 1.0\r\n";
		$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
		$headers .= "From: ".$site_email."\r\n";
		//$subject  = $email_from." has sent you a Site Link : ".$site_address;
		$message  = "<html><head><meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' /><title>".$site_title."</title></head>";
		$message .= "<body>
					<table width='780' border='0' cellspacing='0' cellpadding='1' ><tr><td>
					<table width='100%' border='0' cellspacing='0' cellpadding='0'>
					<tr><td><img src='".$non_secure_path."uploadedfiles/real/".$site_logo."' ></td></tr>
					<tr><td>&nbsp;</td></tr>
					<tr><td height='1' bgcolor='#e3e3e3'><img src='".$non_secure_path."images/spacer.gif' width='1' height='1' /></td></tr>
					<tr><td>&nbsp;</td></tr>
					<tr><td align='center'>
						<table width='80%' border='0'cellspacing='0' cellpadding='0'>
						 <tr><td  align='left' ><font face='Verdana' size='2' color='#000000'>Hello,
							<br><br>$email_from believes the following link will be helpful to you:
							<br><br>".$link_to_send."
							<br><br>";
						if($message1!=''){
							$message .= "<b>Personal Message from ".$email_from." </b><br><br>".$message1;
						}
						$message.="</td></tr></table>
					</td></tr>
					<tr><td>&nbsp;</td></tr>
		  <tr>
			<td height='1' bgcolor='#e3e3e3'><img src='".$non_secure_path."images/spacer.gif' width='1' height='1' /></td>
		  </tr>
		  <tr>
			<td><table width='100%'  border='0' cellpadding='0' cellspacing='0'>
			  
			  <tr valign='middle'>
				<td height='15' colspan='2'>&nbsp;</td>
				</tr>
			  <tr align='center' valign='middle'>
				<td height='22' colspan='2'><font face='Verdana' size='2' color='#000000'>2008-2009 Copyright ".$site_address.". All Rights Reserved.</font></td>
				</tr>
			</table></td>
		  </tr>
		</table></td></td></table>
		</body>
		</html>";
	$to	=	$email_to;
	@mail($to, $subject, $message, $headers);
	$_SESSION['sess_msg'] = "SITE LINK HAS BEEN SENT SUCCESSFULLY.";
	header("location: send_to_friend.php");
	exit();
}else{
	$_SESSION['sess_msg'] = "PLEASE FILL BOTH THE EMAIL ADDRESS";
	header("location: send_to_friend.php");
	exit();
}
?>