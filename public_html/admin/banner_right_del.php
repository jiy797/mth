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


$arr_ids  = $_POST['ids'];
$start    = $_POST['start'];

if(count($arr_ids)>0){
	$str_ids=implode("','",$arr_ids);

	if($_POST['delete']!=''){
		
		//---------------- DELETE PDF -----------------------------
		
		$sql_ban="select * from yp_banner_right where b_id in ('$str_ids') " ;
		$res_ban=executeQuery($sql_ban);

		while($line_ban=mysql_fetch_array($res_ban)){
			$rec_img = $line_ban['b_img'];
			@unlink("../uploadedfiles/banner/".$rec_img);
			
		}
		

		$sql="delete from yp_banner_right where b_id in ('$str_ids') " ;
		executeUpdate($sql);
	}
	else if($_POST['Active']!=''){
		$sql="update yp_banner_right set status= 'Active' where b_id in ('$str_ids') " ;	
		executeUpdate($sql);
	}
	else if($_POST['Inactive']!=''){
		$sql="update yp_banner_right set status= 'Inactive' where b_id in ('$str_ids') " ;	
		executeUpdate($sql);
	}
}


header("Location: banner_right_list.php?start=$start");
exit;

?>