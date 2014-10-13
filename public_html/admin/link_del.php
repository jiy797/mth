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


	$arr_u_ids  = $_POST['u_ids'];
	$start  = $_POST['start'];

	if($_POST['ADD']!=""){
		header("Location: link_add_frm.php");
		exit();
	}	

	if(count($arr_u_ids)>0){
	$str_u_ids=implode("','",$arr_u_ids);

		if($_POST['Delete']!=''){

			foreach($arr_u_ids as $aid){

				$sql="select * from yp_links where link_id='$aid'";
				$result=executeQuery($sql);

				while($line=mysql_fetch_array($result)){
					$link_id	   = $line['link_id'];
					$link_name	   = $line['link_name'];
					$link_position = $line['link_position'];

		
					$sql_lp="select * from yp_links where link_position>'$link_position' order by link_position asc";
					$res_lp=executeQuery($sql_lp);

					while($lin_lp=mysql_fetch_array($res_lp)){
						$link_id	   = $lin_lp['link_id'];
						$link_position = $lin_lp['link_position'];

						$new_link_position = $link_position-1;

						$sql_up="update yp_links set link_position='$new_link_position' where link_id='$link_id'";
						executeUpdate($sql_up);
					
					}
				
					$sql_del="delete from yp_links where link_id='".$line['link_id']."'" ;	
					executeQuery($sql_del);
				}

			}


			$sql="delete from yp_links where link_id in ('$str_u_ids') " ;	
			executeQuery($sql);
		}else if($_POST['Active']!=''){
			$sql="update yp_links set link_status='Active' where link_id in ('$str_u_ids')";	
			executeQuery($sql);
		}else if($_POST['Inactive']!=''){
			$sql="update yp_links set link_status='Inactive' where link_id in ('$str_u_ids')";	
			executeQuery($sql);
		}
	}

header("Location: link_list.php?start=$start");
exit;
?>