<?php
include "./includes/application_top.php";


$pid		= $_POST['pid'];
$rev_name	= str_replace("''","'",addslashes($_POST['rev_name']));
$rev_email	= str_replace("''","'",addslashes($_POST['rev_email']));
$rev_rating	= $_POST['rev_rating'];
$rev_details= str_replace("''","'",addslashes($_POST['rev_details']));

$provider_name=getSingleResult("select rec_name from yp_provider where rec_id='$pid'");


if($rev_name==''||$rev_email==''||$rev_rating=='0'||$rev_details==''){
	$sess_msg="PLEASE FILL ALL THE FIELDS.";
	$_SESSION['sess_msg_review']=$sess_msg;		
	header("location: ".$non_secure_path."provider/".$pid."/");
	exit();
}

if($rev_name!=''){
	
	$sql="insert into yp_provider_review(pro_id, rev_name, rev_email, rev_rating, rev_details, status, posttime) values('$pid', '$rev_name', '$rev_email', '$rev_rating', '$rev_details', 'Inactive', now())";
	executeQuery($sql);

	//----------------- Send Email To Owner-------------------------------------------------------------------------

	$sql_an="select rec_name from yp_learning where rec_id='$lid'";
	$lin_an=getSingleResult($sql_an);

	$headers  = "MIME-Version: 1.0\r\n";
	$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
	$headers .= "From: ".$site_email." \r\n";

	$to=$site_email;

	$subject="New Review Posted for Provider on ".$site_address;

	$message="Hello,<br><br>";
	$message.="A new review has been by : ".stripslashes($rev_name)." for Provider : ".stripslashes($provider_name).".<br><br>";
	$message.="Please check <a href='".$non_secure_path."admin/'>Admin Panel</a> for details. <br><br>";
	$message.="Regards,<br><br>";
	$message.=$site_address."<br>";

	@mail($to, $subject, $message, $headers);

	//------------------------------------------------------------------------------------------------------------------

	$sess_msg="THANKS FOR YOUR MESSAGE.";
	$_SESSION['sess_msg_review']=$sess_msg;			
	header("location: ".$non_secure_path."provider/".$pid."/");
	exit();
}else{
	$sess_msg="PLEASE FILL ALL THE FIELDS.";
	$_SESSION['sess_msg_review']=$sess_msg;			
	header("location: ".$non_secure_path."provider/".$pid."/");
	exit();
}

?>