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


$id				= checkInput($_POST['id']);
$bank_id		= str_replace("''","'",addslashes($_POST['bank_id']));
$bank_name		= str_replace("''","'",addslashes($_POST['bank_name']));
$branch_id		= str_replace("''","'",addslashes($_POST['branch_id']));
$branch_address	= str_replace("''","'",addslashes($_POST['branch_address']));
$branch_city	= str_replace("''","'",addslashes($_POST['branch_city']));
$branch_state	= str_replace("''","'",addslashes($_POST['branch_state']));
$branch_country	= str_replace("''","'",addslashes($_POST['branch_country']));

$_SESSION['bank_id']		= $bank_id;
$_SESSION['bank_name']		= $bank_name;
$_SESSION['branch_id']		= $branch_id;
$_SESSION['branch_address']	= $branch_address;
$_SESSION['branch_city']	= $branch_city;
$_SESSION['branch_state']	= $branch_state;
$_SESSION['branch_country']	= $branch_country;

if($bank_id==''||$bank_name==''||$branch_id==''||$branch_address==''||$branch_city==''||$branch_state==''){
	$sess_msg="PLEASE FILL ALL THE REQUIRED FIELDS.";
	$_SESSION['sess_msg']=$sess_msg;			
	header("location: banks_manage_frm.php?id=$id");	
	exit();
}

if($id!=''){
	$sql="update yp_banks set bank_id='$bank_id', bank_name='$bank_name', branch_id='$branch_id', branch_address='$branch_address', branch_city='$branch_city', branch_state='$branch_state', branch_country='$branch_country' where rec_id='$id'";
	executeQuery($sql);

	$sess_msg="RECORD UPDATED SUCESSFULLY.";
	$_SESSION['sess_msg']=$sess_msg;
}else{
	$sql="insert into yp_banks(bank_id, bank_name, branch_id, branch_address, branch_city, branch_state, branch_country, status, posttime) values('$bank_id', '$bank_name', '$branch_id', '$branch_address', '$branch_city', '$branch_state', '$branch_country', 'Active', now())";
	executeQuery($sql);	
	
	$sess_msg="RECORD ADDED SUCESSFULLY.";
	$_SESSION['sess_msg']=$sess_msg;;
}

unset($_SESSION['bank_id']);
unset($_SESSION['bank_name']);
unset($_SESSION['branch_id']);
unset($_SESSION['branch_address']);
unset($_SESSION['branch_city']);
unset($_SESSION['branch_state']);
unset($_SESSION['branch_country']);

header("location: banks_list.php");	
exit();
?>