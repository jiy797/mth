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


	$link_cat_id = checkInput($_POST['link_cat_id']);
	$link_cat_id = checkInput($_POST['link_cat_id']);
	$link_name	 = addslashes(str_replace("''","'",$_POST['link_name']));
	$link_desc	 = addslashes(str_replace("''","'",$_POST['link_desc']));
	$link_ref	 = checkInput($_POST['link_ref']);
	$link_show	 = checkInput($_POST['link_show']);


	if($link_cat_id==''||$link_name==''||$link_ref==''){
		$sess_msg="PLEASE INPUT ALL THE REQUIRED FIELDS.";
		$_SESSION['sess_msg'] = $sess_msg;
		header("location: link_edit_frm.php?link_id=$link_id");
		exit();
	}

	if($link_id!=''){
		$sql="update yp_links set link_cat_id='$link_cat_id', link_name='$link_name', link_desc='$link_desc', link_ref='$link_ref', link_show='$link_show' where link_id='$link_id'";
		executeQuery($sql);

		$sess_msg="RECORD UPDATED SUCCESFULLY";
		$_SESSION['sess_msg'] = $sess_msg;
	}

	header("location: link_list.php");
	exit();

?>