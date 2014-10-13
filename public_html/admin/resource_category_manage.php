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


$id		  =	checkInput($_POST['id']);
$start	  =	checkInput($_POST['start']);
$cat_name = str_replace("''","'",addslashes(checkInput($_POST['cat_name'])));

$_SESSION['cat_name'] = $cat_name;

if($cat_name==''){
	$sess_msg="PLEASE INPUT CATEGORY NAME.";
	$_SESSION['sess_msg'] = $sess_msg;
	header("Location: resource_category_manage_frm.php?id=$id&start=$start");
	exit();	
}



if($id==''){
	$sql="select cat_name from yp_resource_category where cat_name='$cat_name'";
	$res=getSingleResult($sql);

	if($res==$cat_name){
		$sess_msg="THIS NAME ALREADY EXISTS. PLEASE FILL UNIQUE NAME.";
		$_SESSION['sess_msg'] = $sess_msg;
		header("Location: resource_category_manage_frm.php?id=$id&start=$start");
		exit();
	}else{
		
		$sql="insert into yp_resource_category(cat_name, status) values('$cat_name', 'Active')";
		executeQuery($sql);

		$sess_msg="RECORD ADDED SUCCESSFULLY.";
		$_SESSION['sess_msg'] = $sess_msg;;
	}
}else{
	$sql="select cat_name from yp_resource_category where cat_name='$cat_name' and cat_id<>'$id'";
	$res=getSingleResult($sql);

	if($res==$cat_name){
		$sess_msg="THIS NAME ALREADY EXISTS. PLEASE FILL UNIQUE NAME.";
		$_SESSION['sess_msg'] = $sess_msg;
		header("Location: resource_category_manage_frm.php?id=$id&start=$start");
		exit();
	}else{
		$sql="update yp_resource_category set cat_name='$cat_name' where cat_id='$id'";
		executeQuery($sql);
		$sess_msg="RECORD UPDATED SUCCESSFULLY.";
		$_SESSION['sess_msg'] = $sess_msg;
	}
}

unset($_SESSION['cat_name']);

header("location: resource_category_list.php");
exit;
?>