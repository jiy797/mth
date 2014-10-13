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
$rec_img		= checkInput($_POST['rec_img']);

$b_type			= $_POST['b_type'];
$b_page			= $_POST['b_page'];
$b_link			= str_replace("''","'",addslashes($_POST['b_link']));
$b_code			= str_replace("''","'",addslashes($_POST['b_code']));


$_SESSION['b_type'] = $b_type;
$_SESSION['b_page'] = $b_page;
$_SESSION['b_link'] = $b_link;
$_SESSION['b_code'] = $b_code;

if($b_page==''){
	$sess_msg="PLEASE SELECT PAGE.";
	$_SESSION['sess_msg']=$sess_msg;			
	header("location: banner_top_manage_frm.php?id=$id");	
	exit();
}

if($b_type=='Code'){
	if($b_code==''){
		$sess_msg="PLEASE INPUT BANNER SCRIPT/CODE.";
		$_SESSION['sess_msg']=$sess_msg;			
		header("location: banner_top_manage_frm.php?id=$id");	
		exit();
	}
}

if($b_type=='Image'){
	if($b_link==''){
		$sess_msg="PLEASE INPUT LINK URL.";
		$_SESSION['sess_msg']=$sess_msg;	
		header("location: banner_top_manage_frm.php?id=$id");	
		exit();
	}
}
//---------------------- Image Code Starts ---------------------------

	if($_FILES['image1']['name']!=""){
			$ext_allowed	= array ("gif", "jpg", "jpeg", "png");
			$img_prefix		= date('Ymdhis')."_";//str_replace(" ", "_", $product_name)."_";
			$file_name		= $_FILES['image1']['name'];
			$pos			= strrpos($file_name, ".");
			$len			= strlen($file_name);
			$ext			= substr($file_name ,$pos+1, $len-1);
			$ext			= strtolower($ext);
		if (in_array ($ext, $ext_allowed)) {
		if (is_uploaded_file($_FILES['image1']['tmp_name'])){
			$image_real		= $img_prefix.$file_name;
			@copy($_FILES['image1']['tmp_name'], "../uploadedfiles/banner/".$image_real);
						
			@unlink("../uploadedfiles/banner/".$rec_img);
		}
		}
	}else{

		if($id!=''&&$b_type=='Image'){

			if($rec_img!=''){
				$image_real = $rec_img;
			}else{
				$sess_msg="PLEASE UPLOAD BANNER IMAGE.";
				$_SESSION['sess_msg']=$sess_msg;			
				header("location: banner_top_manage_frm.php?id=$id");	
				exit();
			}
		}

		if($id==''&&$b_type=='Image'){
			$sess_msg="PLEASE UPLOAD BANNER IMAGE.";
			$_SESSION['sess_msg']=$sess_msg;			
			header("location: banner_top_manage_frm.php?id=$id");	
			exit();
		}
	}
//---------------------- Image Code Ends ---------------------------

if($id!=''){
	$sql="update yp_banner_top set  b_type='$b_type', b_page='$b_page', b_img='$image_real', b_link='$b_link', b_code='$b_code' where b_id='$id'";
	executeQuery($sql);
	$sess_msg="RECORD UPDATED SUCESSFULLY.";
	$_SESSION['sess_msg']=$sess_msg;
}else{
	$sql="insert into yp_banner_top(b_type, b_page, b_img, b_link, b_code, status) values('$b_type', '$b_page', '$image_real', '$b_link', '$b_code', 'Active')";
	executeQuery($sql);	
	$sess_msg="RECORD ADDED SUCESSFULLY.";
	$_SESSION['sess_msg']=$sess_msg;;
}

unset($_SESSION['b_type']);
unset($_SESSION['b_page']);
unset($_SESSION['b_link']);
unset($_SESSION['b_code']);

header("location: banner_top_list.php");	
exit();
?>