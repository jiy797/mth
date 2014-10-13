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


$id			= checkInput($_GET['id']);
$rec_id		= checkInput($_GET['rec_id']);

if($id!=''){
	$sql_del="delete from yp_provider_compare where pro_id='$id' and rec_id='$rec_id'";
	executeQuery($sql_del);
	
	$sess_msg="RECORD DELETED SUCESSFULLY.";
	$_SESSION['sess_msg']=$sess_msg;

	header("location: provider_compare_frm.php?id=$id");
	exit();

}else{
	$sess_msg="PLEASE SELECT A RECORD TO UPDATE";
	$_SESSION['sess_msg']=$sess_msg;

	header("location: provider_list.php");	
	exit();
}

?>