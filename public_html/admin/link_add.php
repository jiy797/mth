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

	$link_cat_id=	checkInput($_POST['link_cat_id']);
	$link_name	=	addslashes(str_replace("''","'",$_POST['link_name']));
	$link_desc	=	addslashes(str_replace("''","'",$_POST['link_desc']));
	$link_ref	=	checkInput($_POST['link_ref']);
	$link_show	=	checkInput($_POST['link_show']);
	
	$_SESSION['link_cat_id']= $link_cat_id;
	$_SESSION['link_name']	= $link_name;
	$_SESSION['link_desc']	= $link_desc;
	$_SESSION['link_ref']	= $link_ref;
	$_SESSION['link_show']	= $link_show;
	
	if($link_cat_id==''||$link_name==''||$link_ref==''){
		$sess_msg="PLEASE INPUT ALL THE REQUIRED FIELDS.";
		$_SESSION['sess_msg'] = $sess_msg;
		header("location: link_add_frm.php");
		exit();
	
	}

	if($link_name!=''){
		$max_pos=getsingleresult("select max(link_position) from yp_links");
		$max_pos=$max_pos+1;

		$sql="insert into yp_links(link_cat_id, link_name, link_desc, link_ref, link_show, link_position) values('$link_cat_id', '$link_name', '$link_desc', '$link_ref', '$link_show', '$max_pos')";
		executeQuery($sql);
		
		
		unset($_SESSION['link_cat_id']);
		unset($_SESSION['link_name']);
		unset($_SESSION['link_desc']);
		unset($_SESSION['link_ref']);
		unset($_SESSION['link_show']);
		

		$sess_msg="LINK ADDED SUCCESFULLY";
		$_SESSION['sess_msg'] = $sess_msg;
	}

	header("location: link_list.php");
	exit();

?>