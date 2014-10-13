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


$arr_faq_ids  = $_POST['faq_ids'];
$start		  = $_POST['start'];
$id			  = $_POST['id'];

if($_POST['Add']!=""){
	header("Location: provider_faq_manage_frm.php?id=$id");
	exit();
}


if(count($arr_faq_ids)>0){
	$str_faq_ids=implode("','",$arr_faq_ids);

	if($_POST['delete']!=''){

			foreach($arr_faq_ids as $aid){

				$sql="select * from yp_provider_faq where faq_id='$aid'";
				$result=executeQuery($sql);

				while($line=mysql_fetch_array($result)){
					$faq_id		   = $line['faq_id'];
					$faq_position = $line['faq_position'];

		
					$sql_lp="select * from yp_provider_faq where faq_position>'$faq_position' order by faq_position asc";
					$res_lp=executeQuery($sql_lp);

					while($lin_lp=mysql_fetch_array($res_lp)){
						$faq_id		  = $lin_lp['faq_id'];
						$faq_position = $lin_lp['faq_position'];

						$new_faq_position = $faq_position-1;

						$sql_up="update yp_provider_faq set faq_position='$new_faq_position' where faq_id='$faq_id'";
						executeUpdate($sql_up);
					
					}
					
					$sql_del="delete from yp_provider_faq where faq_id='".$line['faq_id']."'" ;	
					executeQuery($sql_del);
				}

			}



		$sql="delete from yp_provider_faq where faq_id in ('$str_faq_ids') " ;
		executeUpdate($sql);
	}
	else if($_POST['Active']!=''){
		$sql="update yp_provider_faq set status= 'Active' where faq_id in ('$str_faq_ids') " ;	
		executeUpdate($sql);
	}
	else if($_POST['Inactive']!=''){
		$sql="update yp_provider_faq set status= 'Inactive' where faq_id in ('$str_faq_ids') " ;	
		executeUpdate($sql);
	}
}


header("Location: provider_faq_list.php?start=$start&id=$id");
exit;

?>