<?php
	
	require "./includes/application_top.php";
	$admin_id = $_SESSION['admin_id'];
	if ($admin_id==""){
	$_SESSION['msg'] = "Session Expired. Please Login Again to Proceed.";
	header("Location:index.php");
	exit();
	}

	$arr_ids	= $_POST['ids'];
	$start		= $_POST['start'];

if(isset($_POST['currency_default']) && !empty($_POST['currency_default'])){
	$sql_up = "update yp_currency set currency_default='Yes', conversion_value='1' where currency_id='".$_POST['currency_default']."' ";
	executeUpdate($sql_up);

	$sql_up = "update yp_currency set currency_default='No', conversion_value='1' where currency_id!='".$_POST['currency_default']."' ";
	executeUpdate($sql_up);
}
if(count($arr_ids)>0){
	$str_ids=implode("','",$arr_ids);

	if($_POST['delete']!=''){

		$sql="delete from yp_currency where currency_id in ('$str_ids') " ;
		executeUpdate($sql);
	}
}


header("Location: currency_frm.php");
exit;

