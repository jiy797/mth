<?php 
	require "./includes/application_top.php";
	$admin_id = $_SESSION['admin_id'];
	if ($admin_id==""){
	$_SESSION['msg'] = "Session Expired. Please Login Again to Proceed.";
	header("Location:index.php");
	exit();
	}

	$currency_id				= $_POST['currency_id']; 
	$currency_sign				= str_replace("''","'",addslashes($_POST['currency_sign'])); 
	$currency_title				= $_POST['currency_title'];  
	$conversion_value			= $_POST['conversion_value'];  
	$currency_status			= $_POST['currency_status']; 

	if($conversion_value=='' || $currency_sign=='' || $currency_title==''){
		$_SESSION['ses_msg'] = " Please Fill all required field";
		header("location: currency_frm.php");
	}

	if($currency_id!=""){
		$sql="update yp_currency set  currency_title='$currency_title', currency_sign='$currency_sign', conversion_value='$conversion_value', currency_status='$currency_status' ";
		$sql.=" where currency_id='$currency_id'";
		executeQuery($sql);
		$_SESSION['sess_msg'] = "Record Updated Successfully.";
	}else{
		if(isset($_POST['currency_sign']) && !empty($_POST['currency_sign']) && isset($_POST['currency_title']) && !empty($_POST['currency_title'])){
			$sql=  "insert into yp_currency (currency_title, currency_sign, conversion_value, currency_status ) ";
			$sql.= "values  ('$currency_title', '$currency_sign', '$conversion_value', '$currency_status') ";
			executeQuery($sql);
			$_SESSION['sess_msg'] = "Record Added Successfully.";
		}
	}

	header("location: currency_frm.php");
	exit();
?>