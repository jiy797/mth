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


$id  = checkInput($_POST['id']);
$pid = $_POST['pid'];
$bid = $_POST['bid'];

$_SESSION['pid'] = $pid;
$_SESSION['bid'] = $bid;

if($pid=='0'||$bid=='0'){
	$sess_msg="PLEASE FILL ALL THE REQUIRED FIELDS.";
	$_SESSION['sess_msg']=$sess_msg;			
	header("location: tablec_manage_frm.php?id=$id");	
	exit();
}

if($id!=''){

	$sql_chk="select count(*) from yp_tablec where pid='$pid' and bid='$bid' and rec_id<>$id";
	$res_chk=getSingleResult($sql_chk);

	if($res_chk>0){
		$sess_msg="SAME VALUES ALREADY ADDED. PLEASE SELECT DIFFERENT VALUES";
		$_SESSION['sess_msg']=$sess_msg;			
		header("location: tablec_manage_frm.php?id=$id");	
		exit();
	}else{
		$sql="update yp_tablec set pid='$pid', bid='$bid' where rec_id='$id'";
		executeQuery($sql);

		$sess_msg="RECORD UPDATED SUCESSFULLY.";
		$_SESSION['sess_msg']=$sess_msg;
	}
	
}else{
	$sql_chk="select count(*) from yp_tablec where pid='$pid' and bid='$bid'";
	$res_chk=getSingleResult($sql_chk);

	if($res_chk>0){
		$sess_msg="SAME VALUES ALREADY ADDED. PLEASE SELECT DIFFERENT VALUES";
		$_SESSION['sess_msg']=$sess_msg;			
		header("location: tablec_manage_frm.php?id=$id");	
		exit();
	}else{
		$sql="insert into yp_tablec(pid, bid, status) values('$pid', '$bid', 'Active')";
		executeQuery($sql);	
		
		$sess_msg="RECORD ADDED SUCESSFULLY.";
		$_SESSION['sess_msg']=$sess_msg;	
	}
}

unset($_SESSION['pid']);
unset($_SESSION['bid']);

header("location: tablec_list.php");	
exit();
?>