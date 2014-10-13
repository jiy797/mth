<?php
include "./includes/application_top.php";

$lid		= $_POST['lid'];
$rec_name	= str_replace("''","'",addslashes($_POST['rec_name']));
$rec_desc	= str_replace("''","'",addslashes($_POST['rec_desc']));

if($rec_name==''||$rec_desc==''){
	$sess_msg="PLEASE FILL BOTH THE FIELDS.";
	$_SESSION['sess_msg_comment']=$sess_msg;			
	header("location: ".$non_secure_path."learning/".$lid."/");	
	exit();
}

if($rec_name!=''){
	
	$sql="insert into yp_learning_comment(lid, rec_name,  rec_desc, status, posttime) values('$lid', '$rec_name', '$rec_desc', 'Inactive', now())";
	executeQuery($sql);

	//----------------- Send Email To Owner-------------------------------------------------------------------------

	$sql_an="select rec_name from yp_learning where rec_id='$lid'";
	$lin_an=getSingleResult($sql_an);

	$headers  = "MIME-Version: 1.0\r\n";
	$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
	$headers .= "From: ".$site_email." \r\n";

	$to=$site_email;

	$subject="New Comment Posted for Learning Center on ".$site_address;

	$message="Hello,<br><br>";
	$message.="A new comment has been by : ".stripslashes($rec_name)." for Learning Center Article : ".stripslashes($lin_an)."<br><br>";
	$message.="Please check <a href='".$non_secure_path."admin/'>Admin Panel</a> for details. <br><br>";
	$message.="Regards,<br><br>";
	$message.=$site_address."<br>";

	@mail($to, $subject, $message, $headers);

	//------------------------------------------------------------------------------------------------------------------

	$sess_msg="THANKS FOR YOUR MESSAGE.";
	$_SESSION['sess_msg_comment']=$sess_msg;			
	header("location: ".$non_secure_path."learning/".$lid."/");	
	exit();
}else{
	$sess_msg="PLEASE FILL BOTH THE FIELDS.";
	$_SESSION['sess_msg_comment']=$sess_msg;			
	header("location: ".$non_secure_path."learning/".$lid."/");	
	exit();
}

?>