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

$arr_fc_ids = $_POST['faq_cat_ids'];
$start		= $_POST['start'];

if(count($arr_fc_ids)>0){
	$str_fc_ids=implode("','",$arr_fc_ids);

	if($_POST['delete']!=''){

		foreach($arr_fc_ids as $aid){

			$sql="select * from yp_faq_category where faq_cat_id='$aid'";
			$result=executeQuery($sql);

			while($line=mysql_fetch_array($result)){
				$faq_cat_id		   = $line['faq_cat_id'];
				$faq_cat_position  = $line['faq_cat_position'];


				$sql_lp="select * from yp_faq_category where faq_cat_position>'$faq_cat_position' order by faq_cat_position asc";
				$res_lp=executeQuery($sql_lp);

				while($lin_lp=mysql_fetch_array($res_lp)){
					$faq_cat_id		  = $lin_lp['faq_cat_id'];
					$faq_cat_position = $lin_lp['faq_cat_position'];

					$new_faq_cat_position = $faq_cat_position-1;

					$sql_up="update yp_faq_category set faq_cat_position='$new_faq_cat_position' where faq_cat_id='$faq_cat_id'";
					executeUpdate($sql_up);
				
				}
							
			}

		}

		$sql="delete from yp_faq where faq_cat_id in ('$str_fc_ids') " ;
		executeUpdate($sql);
		
		$sql="delete from yp_faq_category where faq_cat_id in ('$str_fc_ids') " ;
		executeUpdate($sql);
	}
	else if($_POST['Active']!=''){
		$sql="update yp_faq_category set faq_cat_status= 'Active' where faq_cat_id in ('$str_fc_ids') " ;	
		executeUpdate($sql);
	}
	else if($_POST['Inactive']!=''){
		$sql="update yp_faq_category set faq_cat_status= 'Inactive' where faq_cat_id in ('$str_fc_ids') " ;	
		executeUpdate($sql);
	}
}


header("Location: faq_category_list.php?start=$start");
exit;

?>