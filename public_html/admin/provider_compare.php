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


$id			= checkInput($_POST['id']);
$rec_id		= checkInput($_POST['rec_id']);
$com_id		= checkInput($_POST['com_id']);
$rec_desc	= str_replace("''","'",addslashes($_POST['rec_desc']));

$_SESSION['com_id']	  = $com_id;
$_SESSION['rec_desc'] = $rec_desc;


if($com_id==''||$rec_desc==''){
	$sess_msg="PLEASE FILL ALL THE REQUIRED FIELDS.";
	$_SESSION['sess_msg']=$sess_msg;			
	header("location: provider_compare_frm.php?id=$id&rec_id=$rec_id");	
	exit();
}


if($id!=''){

	if($rec_id==''){
		$sql_chk="select count(*) from yp_provider_compare where pro_id='$id' and com_id='$com_id'";
		$res_chk=getSingleResult($sql_chk);
		
		if($res_chk>0){
			$sess_msg="VALUES ALREADY ADDED FOR SELECTED OPTION.<br />PLEASE SELECT ANOTHER OPTION.";
			$_SESSION['sess_msg']=$sess_msg;			
		}else{
			$sql="insert into yp_provider_compare(pro_id, com_id, rec_desc) values('$id', '$com_id', '$rec_desc')";
			executeQuery($sql);

			$sess_msg="RECORD ADDED SUCESSFULLY.";
			$_SESSION['sess_msg']=$sess_msg;
		}
	}else{
		$sql="update yp_provider_compare set com_id='$com_id', rec_desc='$rec_desc' where pro_id='$id' and rec_id='$rec_id'";
		executeQuery($sql);

		$sess_msg="RECORD UPDATED SUCESSFULLY.";
		$_SESSION['sess_msg']=$sess_msg;
	}

	unset($_SESSION['com_id']);
	unset($_SESSION['rec_desc']);

	header("location: provider_compare_frm.php?id=$id");
	exit();

}else{
	unset($_SESSION['com_id']);
	unset($_SESSION['rec_desc']);

	$sess_msg="PLEASE SELECT A RECORD TO UPDATE";
	$_SESSION['sess_msg']=$sess_msg;

	header("location: provider_list.php");	
	exit();
}

?>
