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
$rec_file		= checkInput($_POST['rec_file']);
$provider_id	= str_replace("''","'",addslashes($_POST['provider_id']));
$rec_name		= str_replace("''","'",addslashes($_POST['rec_name']));
$rec_desc		= str_replace("''","'",addslashes($_POST['rec_desc']));
$rec_url		= str_replace("''","'",addslashes($_POST['rec_url']));
$rec_ori_url	= str_replace("''","'",addslashes($_POST['rec_ori_url']));
$meta_title		= str_replace("''","'",addslashes($_POST['meta_title']));
$meta_keywords	= str_replace("''","'",addslashes($_POST['meta_keywords']));
$meta_desc		= str_replace("''","'",addslashes($_POST['meta_desc']));

$_SESSION['provider_id']	= $provider_id;
$_SESSION['rec_name']		= $rec_name;
$_SESSION['rec_desc']		= $rec_desc;
$_SESSION['rec_url']		= $rec_url;
$_SESSION['rec_ori_url']	= $rec_ori_url;
$_SESSION['meta_title']		= $meta_title;
$_SESSION['meta_keywords']	= $meta_keywords;
$_SESSION['meta_desc']		= $meta_desc;

if($provider_id==''||$rec_name==''||$rec_desc==''){
	$sess_msg="PLEASE FILL ALL THE REQUIRED FIELDS.";
	$_SESSION['sess_msg']=$sess_msg;			
	header("location: provider_manage_frm.php?id=$id");	
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
			@copy($_FILES['image1']['tmp_name'], "../uploadedfiles/real/".$image_real);
						
			@unlink("../uploadedfiles/real/".$rec_file);
		}
		//}
	}else{
		$image_real = $rec_file;
	}
//---------------------- Image Code Ends ---------------------------


if($id!=''){
	$sql="update yp_provider set provider_id='$provider_id', rec_name='$rec_name', rec_desc='$rec_desc', rec_img='$image_real', rec_url='$rec_url', rec_ori_url='$rec_ori_url', meta_title='$meta_title', meta_keywords='$meta_keywords', meta_desc='$meta_desc' where rec_id='$id'";
	executeQuery($sql);
	$sess_msg="RECORD UPDATED SUCESSFULLY.";
	$_SESSION['sess_msg']=$sess_msg;
}else{
	$max_pos=getsingleresult("select max(rec_position) from yp_provider");
	$max_pos=$max_pos+1;

	$sql="insert into yp_provider(provider_id, rec_name, rec_desc, rec_img, rec_url, rec_ori_url, status, posttime, rec_position, meta_title, meta_keywords, meta_desc) values('$provider_id', '$rec_name', '$rec_desc', '$image_real', '$rec_url', '$rec_ori_url', 'Active', now(), '$max_pos', '$meta_title', '$meta_keywords', '$meta_desc')";
	executeQuery($sql);	

	$max_rec=getsingleresult("select max(rec_id) from yp_provider");

	$sql_ins="insert into yp_provider_overview(pro_id, rec_desc) values('$max_rec','')";
	executeQuery($sql_ins);
	
	$sess_msg="RECORD ADDED SUCESSFULLY.";
	$_SESSION['sess_msg']=$sess_msg;;
}

unset($_SESSION['provider_id']);
unset($_SESSION['rec_name']);
unset($_SESSION['rec_desc']);
unset($_SESSION['meta_title']);
unset($_SESSION['meta_keywords']);
unset($_SESSION['meta_desc']);
unset($_SESSION['rec_url']);
unset($_SESSION['rec_ori_url']);

header("location: provider_list.php");	
exit();
?>