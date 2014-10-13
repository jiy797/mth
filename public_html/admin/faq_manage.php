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


$faq_id		= checkInput($_POST['faq_id']);
$faq_cat_id	= checkInput($_POST['faq_cat_id']);
$question	= str_replace("''","'",addslashes($_POST['question']));
$answer		= str_replace("''","'",addslashes($_POST['answer']));

$_SESSION['faq_cat_id']	= $faq_cat_id;
$_SESSION['question']	= $question;
$_SESSION['answer']		= $answer;

if($question==''||$answer==''){
	$sess_msg="PLEASE FILL ALL THE REQUIRED FIELDS.";
	$_SESSION['sess_msg']=$sess_msg;			
	header("location: faq_manage_frm.php?faq_id=$faq_id");	
	exit();
}

if($faq_id!=''){
	$sql="update yp_faq set faq_cat_id='$faq_cat_id', question='$question', answer='$answer', updatetime=now() where faq_id='$faq_id'";
	executeQuery($sql);
	$sess_msg="RECORD UPDATED SUCESSFULLY.";
	$_SESSION['sess_msg']=$sess_msg;
}else{

	$max_pos=getsingleresult("select max(faq_position) from yp_faq");
	$max_pos=$max_pos+1;

	$sql="insert into yp_faq(faq_cat_id, question, answer, status, posttime, updatetime, faq_position) values('$faq_cat_id', '$question', '$answer', 'Active', now(), now(), '$max_pos')";
	executeQuery($sql);	
	
	$sess_msg="RECORD ADDED SUCESSFULLY.";
	$_SESSION['sess_msg']=$sess_msg;;

}

unset($_SESSION['faq_cat_id']);
unset($_SESSION['question']);
unset($_SESSION['answer']);

header("location: faq_list.php");	
exit();
?>