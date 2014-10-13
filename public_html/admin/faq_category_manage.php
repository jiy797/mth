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


$fc_id			 = checkInput($_POST['fc_id']);
$faq_cat_name	 = str_replace("''","'",addslashes(checkInput($_POST['faq_cat_name'])));

$_SESSION['faq_cat_name']    = $faq_cat_name;

if($faq_cat_name==''){
	$sess_msg="PLEASE INPUT ALL THE REQUIRED FIELDS.";
	$_SESSION['sess_msg'] = $sess_msg;
	header("Location: faq_category_manage_frm.php?fc_id=$fc_id&start=$start");
	exit();	
}

if($fc_id==''){
	$sql="select faq_cat_name from yp_faq_category where faq_cat_name='$faq_cat_name'";
	$res=getSingleResult($sql);

	if($res==$faq_cat_name){
		$sess_msg="THIS NAME ALREADY EXISTS. PLEASE FILL UNIQUE NAME.";
		$_SESSION['sess_msg'] = $sess_msg;
		header("Location: faq_category_manage_frm.php?fc_id=$fc_id&start=$start");
		exit();
	}else{

		$max_pos=getsingleresult("select max(faq_cat_position) from yp_faq_category");
		$max_pos=$max_pos+1;

		$sql="insert into yp_faq_category(parent_cat_id, faq_cat_name, faq_cat_position, faq_cat_status, faq_cat_posttime, faq_cat_updatetime) values('0', '$faq_cat_name', '$max_pos', 'Active', now(), now())";

		executeQuery($sql);
		$sess_msg="RECORD ADDED SUCCESSFULLY.";
		$_SESSION['sess_msg'] = $sess_msg;;
	}
}else{
	$sql="select faq_cat_name from yp_faq_category where faq_cat_name='$faq_cat_name' and faq_cat_id<>'$fc_id'";
	$res=getSingleResult($sql);

	if($res==$faq_cat_name){
		$sess_msg="THIS NAME ALREADY EXISTS. PLEASE FILL UNIQUE NAME.";
		$_SESSION['sess_msg'] = $sess_msg;
		header("Location: faq_category_manage_frm.php?fc_id=$fc_id&start=$start");
		exit();
	}else{
		$sql="update yp_faq_category set faq_cat_name='$faq_cat_name', faq_cat_updatetime=now() where faq_cat_id='$fc_id'";
		executeQuery($sql);
		$sess_msg="RECORD UPDATED SUCCESSFULLY.";
		$_SESSION['sess_msg'] = $sess_msg;
	}
}
unset($_SESSION['faq_cat_name']);
header("location: faq_category_list.php");
exit;
?>