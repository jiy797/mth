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

$newsletter_ids  = $_POST['ids'];
$start  = $_POST['start'];


if(count($newsletter_ids)>0){
	$str_newsletter_ids=implode("','",$newsletter_ids);

	if($_POST['Delete']!=''){
		$sql="delete from yp_newsletter where newsletter_id in ('$str_newsletter_ids') " ;
		executeUpdate($sql);
	}
	else if($_POST['Active']!=''){
		$sql="update yp_newsletter set newsletter_status= 'Active' where newsletter_id in ('$str_newsletter_ids') " ;	
		executeUpdate($sql);
	}
	else if($_POST['Inactive']!=''){
		$sql="update yp_newsletter set newsletter_status= 'Inactive' where newsletter_id in ('$str_newsletter_ids') " ;	
		executeUpdate($sql);
	}
	
}else{

$sess_msg="PLEASE SELECT AT LEAST ONE RECORD.";
$_SESSION['sess_msg'] = $sess_msg;
}


header("Location: newsletter_list.php?start=$start");

?>