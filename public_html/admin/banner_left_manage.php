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

$id				= checkInput($_POST['id']);
$b_code			= str_replace("''","'",addslashes($_POST['b_code']));

$_SESSION['b_code'] = $b_code;

if($b_code==''){
	$sess_msg="PLEASE INPUT BANNER SCRIPT/CODE.";
	$_SESSION['sess_msg']=$sess_msg;			
	header("location: banner_left_manage_frm.php?id=$id");	
	exit();
}

if($id!=''){
	$sql="update yp_banner_left set  b_code='$b_code' where b_id='$id'";
	executeQuery($sql);
	$sess_msg="RECORD UPDATED SUCESSFULLY.";
	$_SESSION['sess_msg']=$sess_msg;
}else{
	$sql="insert into yp_banner_left(b_code, status) values('$b_code', 'Active')";
	executeQuery($sql);	
	$sess_msg="RECORD ADDED SUCESSFULLY.";
	$_SESSION['sess_msg']=$sess_msg;;
}

unset($_SESSION['b_code']);

header("location: banner_left_list.php");	
exit();
?>