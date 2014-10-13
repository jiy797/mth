<?php
include "./includes/application_top.php";

$admin_id=$_SESSION['admin_id'];
if ($admin_id=="")
{
	$msg="Session Expired. Please Login Again to Proceed.";
	$_SESSION['msg']=$msg;
	header("Location:index.php");
	exit();
}

$id			= $_POST['id'];
$rec_id		= $_POST['rec_id'];
$rec_name	= str_replace("''","'",addslashes($_POST['rec_name']));
$rec_desc   = str_replace("''","'",addslashes($_POST['rec_desc']));

if($rec_name==''||$rec_name==''){
	$sess_msg="PLEASE FILL ALL THE FIELDS.";
	$_SESSION['sess_msg']=$sess_msg;		
	header("Location: mtb_comment_view.php?id=$id&rec_id=$rec_id");
	exit();
}

if($rec_id!=''){
	$sql="update yp_mtb_comment set rec_name='$rec_name', rec_desc='$rec_desc' where rec_id='$rec_id'";
	executeQuery($sql);

	$sess_msg="RECORD UPDATED SUCCESSFULLY.";
	$_SESSION['sess_msg']=$sess_msg;			
	header("Location: mtb_comment_view.php?id=$id&rec_id=$rec_id");
	exit();
}else{
	$sess_msg="PLEASE SELECT A RECORD TO UPDATE,";
	$_SESSION['sess_msg']=$sess_msg;			
	header("location: mtb_list.php");
	exit();
}

?>