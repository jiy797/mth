<?php

require "./includes/application_top.php";

$admin_id = checkInput($_POST['admin_id']);
$password = checkInput($_POST['password']);

$login_succeed="false";

$sql="select * from yp_admin where admin_id='$admin_id' and status='Active'";
$result=executeQuery($sql);


if($line=mysql_fetch_array($result)){
	if(isValid_password($password,$line['password'])){
		$login_succeed="true";
	}
	if ($login_succeed=="true"){
		$_SESSION['admin_id'] = $admin_id;
		header("Location: welcome.php");
		exit;
	}else{
		$_SESSION['msg']="Invalid Administrator ID or Password ";
		header("Location: index.php");
		exit;
	}
}else{
	$_SESSION['msg'] = "Invalid Administrator ID or Password ";
	header("Location: index.php");
	exit;
}
?>