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
$cat_id			= checkInput($_POST['cat_id']);
$rec_file		= checkInput($_POST['rec_file']);
$rec_name		= str_replace("''","'",addslashes(checkInput($_POST['rec_name'])));
$rec_desc		= str_replace("''","'",addslashes($_POST['rec_desc']));
$rec_date		= checkInput($_POST['rec_date']);
$meta_title		= str_replace("''","'",addslashes($_POST['meta_title']));
$meta_keywords	= str_replace("''","'",addslashes($_POST['meta_keywords']));
$meta_desc		= str_replace("''","'",addslashes($_POST['meta_desc']));
$option_from	= checkInput($_POST['option_from']);
$option_to		= checkInput($_POST['option_to']);
$rec_url		= str_replace("''","'",addslashes($_POST['rec_url']));

$_SESSION['cat_id']			= $cat_id;
$_SESSION['rec_name']		= $rec_name;
$_SESSION['rec_desc']		= $rec_desc;
$_SESSION['rec_date']		= $rec_date;
$_SESSION['meta_title']		= $meta_title;
$_SESSION['meta_keywords']	= $meta_keywords;
$_SESSION['meta_desc']		= $meta_desc;
$_SESSION['option_from']	= $option_from;
$_SESSION['option_to']		= $option_to;
$_SESSION['rec_url']		= $rec_url;


if($cat_id=='0'||$rec_name==''||$rec_date==''||$rec_desc==''){
	$sess_msg="PLEASE FILL ALL THE REQUIRED FIELDS.";
	$_SESSION['sess_msg']=$sess_msg;			
	header("location: resource_manage_frm.php?id=$id");	
	exit();
}


//---------------------- Image Code Starts ---------------------------

	if($_FILES['image1']['name']!=""){
			//$ext_allowed	= array ("gif", "jpg", "jpeg", "png");
			$img_prefix		= date('Ymdhis')."_";//str_replace(" ", "_", $product_name)."_";
			$file_name		= $_FILES['image1']['name'];
			$pos			= strrpos($file_name, ".");
			$len			= strlen($file_name);
			$ext			= substr($file_name ,$pos+1, $len-1);
			$ext			= strtolower($ext);
		//if (in_array ($ext, $ext_allowed)) {
		if (is_uploaded_file($_FILES['image1']['tmp_name'])){
			$image_real		= $img_prefix.$file_name;
			@copy($_FILES['image1']['tmp_name'], "../uploadedfiles/pdf/".$image_real);
						
			@unlink("../uploadedfiles/pdf/".$rec_file);
		}
		//}
	}else{
		$image_real = $rec_file;
	}
//---------------------- Image Code Ends ---------------------------

$rec_date = substr($rec_date,6,4)."-".substr($rec_date,0,2)."-".substr($rec_date,3,2);

if($id!=''){
	$sql="update yp_resource set cat_id='$cat_id', rec_name='$rec_name',  rec_date='$rec_date', rec_desc='$rec_desc', rec_pdf='$image_real', meta_title='$meta_title', meta_keywords='$meta_keywords', meta_desc='$meta_desc', option_from='$option_from', option_to='$option_to', rec_url='$rec_url'  where rec_id='$id'";
	executeQuery($sql);
	$sess_msg="RECORD UPDATED SUCESSFULLY.";
	$_SESSION['sess_msg']=$sess_msg;
}else{
	$max_pos=getsingleresult("select max(rec_position) from yp_resource");
	$max_pos=$max_pos+1;

	$sql="insert into yp_resource(cat_id, rec_name, rec_date, rec_desc, rec_pdf, status, posttime, rec_position, meta_title, meta_keywords, meta_desc, option_from, option_to, rec_url) values('$cat_id', '$rec_name', '$rec_date', '$rec_desc', '$image_real', 'Active', now(), '$max_pos', '$meta_title', '$meta_keywords', '$meta_desc', '$option_from', '$option_to', '$rec_url')";
	executeQuery($sql);	
	
	$sess_msg="RECORD ADDED SUCESSFULLY.";
	$_SESSION['sess_msg']=$sess_msg;;
}

unset($_SESSION['cat_id']);
unset($_SESSION['rec_name']);
unset($_SESSION['rec_date']);
unset($_SESSION['rec_desc']);
unset($_SESSION['meta_title']);
unset($_SESSION['meta_keywords']);
unset($_SESSION['meta_desc']);
unset($_SESSION['option_from']);
unset($_SESSION['option_to']);
unset($_SESSION['rec_url']);

header("location: resource_list.php");	
exit();
?>