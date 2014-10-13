<?php
include "./includes/application_top.php";

$nid		= $_POST['nid'];
$rec_name	= str_replace("''","'",addslashes($_POST['rec_name']));
$rec_desc	= str_replace("''","'",addslashes($_POST['rec_desc']));

if($rec_name==''||$rec_desc==''){
	$sess_msg="PLEASE FILL BOTH THE FIELDS.";
	$_SESSION['sess_msg_comment']=$sess_msg;			
	header("location: ".$non_secure_path."new/".$nid."/");	
	exit();
}

if($rec_name!=''){
	
	$sql="insert into yp_news_comment(nid, rec_name,  rec_desc, status, posttime) values('$nid', '$rec_name', '$rec_desc', 'InActive', now())";
	executeQuery($sql);

	//----------------- Send Email To Owner-------------------------------------------------------------------------

	$sql_an="select rec_name from yp_news where rec_id='$nid'";
	$lin_an=getSingleResult($sql_an);

	$headers  = "MIME-Version: 1.0\r\n";
	$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
	$headers .= "From: ".$site_email." \r\n";

	$to=$site_email;

	$subject="New Comment Posted for News Article on ".$site_address;

	$message="Hello,<br><br>";
	$message.="A new comment has been by : ".stripslashes($rec_name)." for News Article : ".stripslashes($lin_an)."<br><br>";
	$message.="Please check <a href='".$non_secure_path."admin/'>Admin Panel</a> for details. <br><br>";
	$message.="Regards,<br><br>";
	$message.=$site_address."<br>";

	@mail($to, $subject, $message, $headers);

	//------------------------------------------------------------------------------------------------------------------


	$sess_msg="THANKS FOR YOUR MESSAGE.";
	$_SESSION['sess_msg_comment']=$sess_msg;			
	header("location: ".$non_secure_path."new/".$nid."/");	
	exit();
}else{
	$sess_msg="PLEASE FILL BOTH THE FIELDS.";
	$_SESSION['sess_msg_comment']=$sess_msg;			
	header("location: ".$non_secure_path."new/".$nid."/");
	exit();
}

?>