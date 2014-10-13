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

$page_id		= checkInput($_POST['page_id']);
$meta_title		= str_replace("''","'",addslashes($_POST['meta_title']));
$meta_keywords	= str_replace("''","'",addslashes($_POST['meta_keywords']));
$meta_desc		= str_replace("''","'",addslashes($_POST['meta_desc']));
$page_title		= str_replace("''","'",addslashes($_POST['page_title']));
$page_desc		= str_replace("''","'",addslashes($_POST['page_desc']));


$_SESSION['meta_title']		= $meta_title;
$_SESSION['meta_keywords']	= $meta_keywords;
$_SESSION['meta_desc']		= $meta_desc;
$_SESSION['page_title']		= $page_title;
$_SESSION['page_desc']		= $page_desc;

if($page_title==''||$page_desc==''){
	$sess_msg="PLEASE FILL ALL THE REQUIRED FIELDS";
	$_SESSION['sess_msg']=$sess_msg;
	header("location: content_page_frm.php?page_id=$page_id");
	exit;
}

if($page_id==""){
	$sql="insert into yp_content_pages(meta_title, meta_keywords, meta_desc, page_title, page_desc, status) values('$meta_title', '$meta_keywords', '$meta_desc', '$page_title', '$page_desc', 'Active')";
	executeQuery($sql);
	$sess_msg="RECORD ADDED SUCCESSFULLY";
	$_SESSION['sess_msg']=$sess_msg;
}else{
	$sql="update yp_content_pages set meta_title='$meta_title', meta_keywords='$meta_keywords', meta_desc='$meta_desc', page_title='$page_title', page_desc='$page_desc' where page_id='$page_id'";
	executeQuery($sql);
	$sess_msg="RECORD UPDATED SUCCESSFULLY";
	$_SESSION['sess_msg']=$sess_msg;
}

unset($_SESSION['meta_title']);
unset($_SESSION['meta_keywords']);
unset($_SESSION['meta_desc']);
unset($_SESSION['page_title']);
unset($_SESSION['page_desc']);

header("location: content_page_list.php");
exit;

?>