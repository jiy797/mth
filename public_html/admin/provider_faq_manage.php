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
$faq_id		= checkInput($_POST['faq_id']);

$question	= str_replace("''","'",addslashes($_POST['question']));
$answer		= str_replace("''","'",addslashes($_POST['answer']));

$_SESSION['question']	= $question;
$_SESSION['answer']		= $answer;

if($question==''||$answer==''){
	$sess_msg="PLEASE FILL ALL THE REQUIRED FIELDS.";
	$_SESSION['sess_msg']=$sess_msg;			
	header("location: provider_faq_manage_frm.php?id=$id&faq_id=$faq_id");	
	exit();
}

if($faq_id!=''){
	$sql="update yp_provider_faq set question='$question', answer='$answer' where faq_id='$faq_id'";
	executeQuery($sql);
	$sess_msg="RECORD UPDATED SUCESSFULLY.";
	$_SESSION['sess_msg']=$sess_msg;
}else{

	$max_pos=getsingleresult("select max(faq_position) from yp_provider_faq");
	$max_pos=$max_pos+1;

	$sql="insert into yp_provider_faq(pro_id, question, answer, status, posttime, faq_position) values('$id', '$question', '$answer', 'Active', now(), '$max_pos')";
	executeQuery($sql);	
	
	$sess_msg="RECORD ADDED SUCESSFULLY.";
	$_SESSION['sess_msg']=$sess_msg;;

}

unset($_SESSION['question']);
unset($_SESSION['answer']);

header("location: provider_faq_list.php?id=$id");	
exit();
?>