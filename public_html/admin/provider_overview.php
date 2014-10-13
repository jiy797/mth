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


$id			= checkInput($_POST['id']);
$rec_desc	= str_replace("''","'",addslashes($_POST['rec_desc']));

$_SESSION['rec_desc'] = $rec_desc;

/*
if($rec_desc==''){
	$sess_msg="PLEASE FILL ALL THE REQUIRED FIELDS.";
	$_SESSION['sess_msg']=$sess_msg;			
	header("location: provider_overview_frm.php?id=$id");	
	exit();
}
*/

if($id!=''){
	$sql="update yp_provider_overview set rec_desc='$rec_desc' where pro_id='$id'";
	executeQuery($sql);

	$sess_msg="RECORD UPDATED SUCESSFULLY.";
	$_SESSION['sess_msg']=$sess_msg;

	unset($_SESSION['rec_desc']);

	header("location: provider_overview_frm.php?id=$id");
	exit();

}else{
	unset($_SESSION['rec_desc']);
	$sess_msg="PLEASE SELECT A RECORD TO UPDATE";
	$_SESSION['sess_msg']=$sess_msg;

	header("location: provider_list.php");	
	exit();
}

?>