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

$id				= $_POST['id'];
$page_title		= str_replace("''","'",checkInput($_POST['page_title']));
$page_desc		= str_replace("''","'",$_POST['page_desc']);
$status			= str_replace("''","'",$_POST['status']);

$_SESSION['page_title']		= $page_title;
$_SESSION['page_desc']		= $page_desc;
$_SESSION['status']			= $status;

if($page_title==''||$page_desc==''){
	$sess_msg="PLEASE FILL ALL THE REQUIRED FIELDS";
	$_SESSION['sess_msg']=$sess_msg;
	header("location: site_down_frm.php?id=$id");
	exit;
}


if($id==""){
	$sql="insert into yp_site_down(page_title, page_desc, status) values('$page_title', '$page_desc', '$status')";
	executeQuery($sql);

	$_SESSION['sess_msg']="RECORD ADDED SUCCESSFULLY";

}else{
	$sql="update yp_site_down set page_title='$page_title', page_desc='$page_desc', status='$status' where id='$id'";
	executeQuery($sql);

	$_SESSION['sess_msg']="RECORD UPDATED SUCCESSFULLY";
}
unset($_SESSION['page_title']);
unset($_SESSION['page_desc']);
unset($_SESSION['status']);


header("location: site_down_frm.php");
exit;
?>