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

$arr_ids	= $_POST['ids'];
$start		= $_POST['start'];

if($_POST['Add']!=""){
	header("Location: content_page_frm.php");
	exit();
}

if(count($arr_ids)>0){
	$str_ids=implode("','",$arr_ids);
	if($_POST['Delete']!=''){
		$sql="delete from yp_content_pages where page_id in ('$str_ids')";
		executeUpdate($sql);
	}else if($_POST['Active']!=''){
		$sql="update yp_content_pages set status= 'Active' where page_id in ('$str_ids') " ;	
		executeUpdate($sql);
	}else if($_POST['Inactive']!=''){
		$sql="update yp_content_pages set status= 'Inactive' where page_id in ('$str_ids') " ;	
		executeUpdate($sql);
	}
}
header("Location: content_page_list.php?start=$start");
exit;
?>
