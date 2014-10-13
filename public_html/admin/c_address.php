<?php
require "./includes/application_top.php";	

$admin_id=$_SESSION['admin_id'];
if ($admin_id=="")
{
	$msg="Session Expired. Please Login Again to Proceed.";
	$_SESSION['msg']=$msg;
	header("Location:index.php");
	exit();
}

$page_id		= $_POST['page_id'];
$page_text		= str_replace("''","'",$_POST['text_area']);
$page_top_desc	= str_replace("''","'",$_POST['page_top_desc']);

if($page_id==""){
	$sql="insert into yp_c_address(page_text, page_top_desc) values('$page_text','$page_top_desc')";
	executeQuery($sql);
}else{
	$sql="update yp_c_address set page_text='$page_text', page_top_desc='$page_top_desc'  where page_id='$page_id'";
	executeQuery($sql);
}
header("location: c_address_frm.php");
exit;
?>
