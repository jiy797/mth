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

$id			= $_POST['id'];
$subject	= $_POST['subject'];
$graphics	= $_POST['graphics'];
$text		= str_replace("''","'",addslashes($_POST["text"]));

$_SESSION['subject'] = $subject;
$_SESSION['graphics']= $graphics;
$_SESSION['text']	 = $text;


if($subject==''){
	$sess_msg="PLEASE INPUT SUBJECT";
	$_SESSION['sess_msg'] = $sess_msg;
	header("location: newsletter_manage_frm.php?id=$id");
	exit();
}

if(($graphics=='')&& ($text=='')){
	$sess_msg="PLEASE INPUT EITHER GRAPHICS OR TEXT DETAILS";
	$_SESSION['sess_msg'] = $sess_msg;
	header("location: newsletter_manage_frm.php?id=$id");
	exit();
}

if($id!=''){
	$sql= "update yp_newsletter set newsletter_subject='$subject', newsletter_graphics='$graphics', newsletter_text='$text' where newsletter_id='$id'";
	executeQuery($sql);

}else{
	$sql= "insert into yp_newsletter(newsletter_subject, newsletter_graphics, newsletter_text, newsletter_postdate, newsletter_status) values('$subject', '$graphics', '$text', now(), 'Active')";
	executeupdate($sql);
}

unset($_SESSION['subject']);
unset($_SESSION['graphics']);
unset($_SESSION['text']);

$sess_msg="RECORD ADDED SUCCESSFULLY.";
$_SESSION['sess_msg'] = $sess_msg;
header("location: newsletter_list.php");
exit();

?>