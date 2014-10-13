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


$arr_cids	= $_POST['ids'];
$start		= $_POST['start'];

if(count($arr_cids)>0){
	$str_cids=implode("','",$arr_cids);
	if($_POST['Delete']!=''){

		foreach($arr_cids as $aid){

				$sql="select * from yp_links_category where category_id='$aid'";
				$result=executeQuery($sql);

				while($line=mysql_fetch_array($result)){
					$category_id = $line['category_id'];
					$position	 = $line['position'];

		
					$sql_lp="select * from yp_links_category where position>'$position' order by position asc";
					$res_lp=executeQuery($sql_lp);

					while($lin_lp=mysql_fetch_array($res_lp)){
						$category_id  = $lin_lp['category_id'];
						$position     = $lin_lp['position'];

						$new_position = $position-1;

						$sql_up="update yp_links_category set position='$new_position' where category_id='$category_id'";
						executeUpdate($sql_up);
					
					}
				
					$sql_del="delete from yp_links_category where category_id='".$line['link_id']."'" ;	
					executeQuery($sql_del);
				}

			}

		$sql="delete from yp_links where link_cat_id in ('$str_cids')";	
		executeQuery($sql);

		$sql="delete from yp_links_category where category_id in ('$str_cids')";	
		executeQuery($sql);  
	}else if($_POST['Active']!=''){
		$sql="update yp_links_category set category_status='Active' where category_id in ('$str_cids')";	
		executeQuery($sql);
	}else if($_POST['Inactive']!=''){
		$sql="update yp_links_category set category_status='Inactive' where category_id in ('$str_cids')";	
		executeQuery($sql);
	}
}
header("Location: links_category_list.php?start=$start");
exit;
?>