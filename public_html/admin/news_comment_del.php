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
$id		= $_POST['id'];

if(count($arr_ids)>0){
	$str_ids=implode("','",$arr_ids);

	if($_POST['delete']!=''){
		$sql="delete from yp_news_comment where rec_id in ('$str_ids') " ;
		executeUpdate($sql);
	}
	else if($_POST['Active']!=''){
		$sql="update yp_news_comment set status= 'Active' where rec_id in ('$str_ids') " ;	
		executeQuery($sql);
	}
	else if($_POST['Inactive']!=''){
		$sql="update yp_news_comment set status= 'Inactive' where rec_id in ('$str_ids') " ;	
		executeQuery($sql);
	}
}

header("Location: news_comment_list.php?start=$start&id=$id");
exit;
?>