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
$rev_name	= str_replace("''","'",addslashes($_POST['rev_name']));
$rev_email	= str_replace("''","'",addslashes($_POST['rev_email']));
$rev_rating	= $_POST['rev_rating'];
$rev_details= str_replace("''","'",addslashes($_POST['rev_details']));

if($rev_name==''||$rev_email==''||$rev_rating=='0'||$rev_details==''){
	$sess_msg="PLEASE FILL ALL THE FIELDS.";
	$_SESSION['sess_msg']=$sess_msg;		
	header("Location: provider_review_manage_frm.php?id=$id&rec_id=$rec_id");
	exit();
}

if($rec_id!=''){
	$sql="update yp_provider_review set rev_name='$rev_name', rev_email='$rev_email', rev_rating='$rev_rating', rev_details='$rev_details' where rec_id='$rec_id'";
	executeQuery($sql);

	$sess_msg="RECORD UPDATED SUCCESSFULLY.";
	$_SESSION['sess_msg']=$sess_msg;			
	header("Location: provider_review_manage_frm.php?id=$id&rec_id=$rec_id");
	exit();
}else{
	$sess_msg="PLEASE SELECT A RECORD TO UPDATE,";
	$_SESSION['sess_msg']=$sess_msg;			
	header("location: provider_list.php");
	exit();
}

?>