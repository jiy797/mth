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

	$cat_name		=	addslashes(str_replace("''","'",$_POST['cat_name']));
	$cat_desc		=	addslashes(str_replace("''","'",$_POST['cat_desc']));
	$cat_id			=	$_POST['cat_id'];
	$parent_cat_id	=	'0';
	if($_POST['start']!=''){
	$start			=	$_POST['start'];
	}else{
	$start			=	'0';
	}

	if($cat_name==''){
		$_SESSION['sess_msg'] = "PLEASE INPUT CATEGORY NAME.";
		header("Location: links_category_frm.php?cat_id=$cat_id&start=$start");
		exit();
	}

	$sql_p="select parent_cat_id from yp_links_category where category_id='$parent_cat_id'";
	$pcid=getsingleresult($sql_p);

	if($pcid>'0'){
		$_SESSION['sess_msg'] = "YOU CANNOT ADD SUB-CATEGORY TO SUB-CATEGORY.<br>PLEASE SELECT A PARENT CATEGORY.";
		header("Location: links_category_frm.php?cat_id=$cat_id&start=$start");
		exit();	
	}

	if($cat_id!=""){
		$sql="select category_name from yp_links_category where category_name='$cat_name' and parent_cat_id='$parent_cat_id' and category_id<>'$cat_id'";
		$res=getSingleResult($sql);

		if($res==$cat_name){
			$_SESSION['sess_msg'] = "CATEGORY NAME ALREADY EXISTS.<br>PLEASE INPUT ANOTHER VALUE.";
			header("Location: links_category_frm.php?cat_id=$cat_id&start=$start");
			exit();
		}else{
			$sql="update yp_links_category set category_name='$cat_name', category_desc='$cat_desc', parent_cat_id='$parent_cat_id', category_image='$image_real', category_updatetime=now() where category_id='$cat_id'";
			executeQuery($sql);
			$_SESSION['sess_msg'] = "RECORD UPDATED SUCCESSFULLY.";
		}
	}else{
		
		$sql="select category_name from yp_links_category where category_name='$cat_name' and parent_cat_id='$parent_cat_id'";
		$res=getSingleResult($sql);

		if($res==$cat_name){
			$_SESSION['sess_msg'] = "CATEGORY NAME ALREADY EXISTS.<br>PLEASE INPUT ANOTHER VALUE.";
			header("Location: links_category_frm.php");
			exit();
		}else{
			$max_pos=getsingleresult("select max(position) from yp_links_category");
			$max_pos=$max_pos+1;

			$sql="insert into yp_links_category(parent_cat_id, category_name, category_desc, category_image, category_posttime, category_updatetime, position) values('$parent_cat_id', '$cat_name', '$cat_desc', '$image_real', now(), now(), '$max_pos')";
			executeQuery($sql);
			$_SESSION['sess_msg'] = "RECORD ADDED SUCCESSFULLY.";
		}
	}

	header("location: links_category_list.php?start=$start");
	exit;
?>
