<?php
	require "./includes/application_top.php";	
	$admin_id=$_SESSION['admin_id'];
	if ($admin_id==""){
		$msg="Session Expired. Please Login Again to Proceed.";
		$_SESSION['msg']=$msg;
		header("Location:index.php");
		exit();
	}

	$setting_id				= checkInput($_POST['setting_id']);
	$image_real				= checkInput($_POST['site_logo']);
	$ss_site_title			= str_replace("''","'",checkInput($_POST['site_title']));
	$ss_site_address		= str_replace("''","'",checkInput($_POST['site_address']));
	$ss_site_email_to		= str_replace("''","'",checkInput($_POST['site_email_to']));
	$ss_site_email_from		= str_replace("''","'",checkInput($_POST['site_email_from']));
	$ss_site_meta_title		= str_replace("''","'",$_POST['site_meta_title']);
	$ss_site_meta_author	= str_replace("''","'",$_POST['site_meta_author']);
	$ss_site_meta_copyright	= str_replace("''","'",$_POST['site_meta_copyright']);
	$ss_site_meta_desc		= str_replace("''","'",$_POST['site_meta_desc']);
	$ss_site_meta_phrase	= str_replace("''","'",$_POST['site_meta_phrase']);
	$ss_site_meta_words		= str_replace("''","'",$_POST['site_meta_words']);

	$ss_site_phone			= str_replace("''","'",checkInput($_POST['site_phone']));
	$ss_site_copyright		= str_replace("''","'",$_POST['site_copyright']);

	if($_FILES['logo_file']['name']!=""){
			$ext_allowed = array ("gif", "jpg", "jpeg", "png");
			$img_prefix	 = date("mdyhis");
			$file_name	 = $_FILES['logo_file']['name'];
			$pos		 = strrpos($file_name, ".");
			$len		 = strlen($file_name);
			$ext		 = substr($file_name, $pos+1, $len-1);
			$ext		 = strtolower($ext);

			if (in_array ($ext, $ext_allowed)) {
			if (is_uploaded_file($_FILES['logo_file']['tmp_name'])){
				$source_dir   = "../uploadedfiles/real/";
				$image_real   = $img_prefix.$file_name;
				@copy($_FILES['logo_file']['tmp_name'], $source_dir.$image_real);
				if($setting_id!=""){
					$imgr = getSingleResult("select site_logo from yp_site_settings where setting_id='".$setting_id."'");
					@unlink($source_dir.$imgr);
				}
			}
			}
	}

	if($setting_id==""){
		$sql="insert into yp_site_settings(site_title, site_address, site_email_to, site_email_from, site_meta_title, site_meta_author, site_meta_copyright, site_meta_desc, site_meta_phrase, site_meta_words, site_logo, site_phone, site_copyright) values('$ss_site_title', '$ss_site_address', '$ss_site_email_to', '$ss_site_email_from', '$ss_site_meta_title', '$ss_site_meta_author', '$ss_site_meta_copyright', '$ss_site_meta_desc', '$ss_site_meta_phrase', '$ss_site_meta_words', '$image_real', '$ss_site_phone', '$ss_site_copyright')";
		executeQuery($sql);
	}else{
		$sql="update yp_site_settings set site_title='$ss_site_title', site_address='$ss_site_address', site_email_to='$ss_site_email_to', site_email_from='$ss_site_email_from', site_meta_title='$ss_site_meta_title', site_meta_author='$ss_site_meta_author', site_meta_copyright='$ss_site_meta_copyright', site_meta_desc='$ss_site_meta_desc', site_meta_phrase='$ss_site_meta_phrase', site_meta_words='$ss_site_meta_words', site_logo='$image_real', site_phone='$ss_site_phone', site_copyright='$ss_site_copyright' where setting_id='$setting_id'";
		executeQuery($sql);
	}
	header("location: site_settings_frm.php");
	exit;
?>
