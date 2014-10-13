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

$arr_ids= $_POST['ids'];
$start  = $_POST['start'];

if(count($arr_ids)>0){
	$str_ids=implode("','",$arr_ids);

	if($_POST['delete']!=''){
		$sql="delete from yp_resource_category where cat_id in ('$str_ids') " ;
		executeQuery($sql);
	}
	else if($_POST['Active']!=''){
		$sql="update yp_resource_category set status= 'Active' where cat_id in ('$str_ids') " ;	
		executeQuery($sql);
	}
	else if($_POST['Inactive']!=''){
		$sql="update yp_resource_category set status= 'Inactive' where cat_id in ('$str_ids') " ;	
		executeQuery($sql);
	}
}
header("Location: resource_category_list.php?start=$start");
exit;
?>