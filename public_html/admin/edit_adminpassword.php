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

$password				=	valid_data(str_replace("''","'",checkInput($_POST['password'])));
$new_pass				=	valid_data(str_replace("''","'",checkInput($_POST['new_pass'])));
$confirm_new_pass		=	valid_data(str_replace("''","'",checkInput($_POST['confirm_new_pass'])));
$login_succeed="false";


	if((ereg("[^A-Za-z0-9_]",$password,$regs))){
		$error_message="Invalid Old Password <br> Only Character Between [a-z A-Z 0-9 _ ] is allowed <br> Space is not allowed";
		$_SESSION['error_message']=$error_message;
		header("Location: edit_adminpassword_frm.php");
		exit();
	}
	if((ereg("[^A-Za-z0-9_]",$new_pass,$regs))){
		$error_message="Invalid New Password <br> Only Character Between [a-z A-Z 0-9 _ ] is allowed <br> Space is not allowed";
		$_SESSION['error_message']=$error_message;
		header("Location: edit_adminpassword_frm.php");
		exit();
	}
	if ($confirm_new_pass != $new_pass){
		$error_message="Password and Re-type password should be same";
		$_SESSION['error_message']=$error_message;
		header("Location: edit_adminpassword_frm.php");
		exit();
    }

if($confirm_new_pass == $new_pass)
{
	$sql="select password from yp_admin where admin_id='$admin_id' ";
	$res=getSingleResult($sql);
	if($res!=""){
		if(isValid_password($password,$res)){
			$login_succeed="true";
		}
		if($login_succeed=="true"){
			$sql  ="UPDATE yp_admin SET password= '".crypt_now($new_pass)."' WHERE admin_id='$admin_id' ";
			executeupdate($sql);
			session_destroy();
			header("location:index.php");
			exit();
		}else{
			$error_message ="Old Password does not match.  Please enter again.";
			$_SESSION['error_message']=$error_message;
			header("location: edit_adminpassword_frm.php");
		}
	}else{
		$error_message ="Old Password does not match.  Please enter again.";
		$_SESSION['error_message']=$error_message;
		header("location: edit_adminpassword_frm.php");

	}
}
else
{
	$error_message ="Password and Confirm password do not match";
	$_SESSION['error_message']=$error_message;
	header("location: edit_adminpassword_frm.php");
	exit;
}
?>
