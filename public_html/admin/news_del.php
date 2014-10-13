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
$start  = $_POST['start'];

if(count($arr_ids)>0){
	$str_ids=implode("','",$arr_ids);

	if($_POST['delete']!=''){
		
		//---------------- DELETE PDF -----------------------------
		
		$sql_gal="select * from yp_news where rec_id in ('$str_ids') " ;
		$res_gal=executeQuery($sql_gal);

		while($line_gal=mysql_fetch_array($res_gal)){
			$rec_pdf = $line_gal['rec_pdf'];
			@unlink("../uploadedfiles/pdf/".$rec_pdf);
			
		}
		

		//------------- DELETE RECORDS ---------------------------------------

		foreach($arr_ids as $aid){

			$sql="select * from yp_news where rec_id='$aid'";
			$result=executeQuery($sql);

			while($line=mysql_fetch_array($result)){
				$rec_id	    = $line['rec_id'];
				$rec_position = $line['rec_position'];
	
				$sql_lp="select * from yp_news where rec_position>'$rec_position' order by rec_position asc";
				$res_lp=executeQuery($sql_lp);

				while($lin_lp=mysql_fetch_array($res_lp)){
					$rec_id		  = $lin_lp['rec_id'];
					$rec_position = $lin_lp['rec_position'];

					$new_rec_position = $rec_position-1;

					$sql_up="update yp_news set rec_position='$new_rec_position' where rec_id='$rec_id'";
					executeUpdate($sql_up);
				
				}
				
				$sql_del="delete from yp_news where rec_id='".$line['rec_id']."'" ;	
				executeQuery($sql_del);
			}
		}

		//---------------------------------------------------------------


		$sql="delete from yp_news where rec_id in ('$str_ids') " ;
		executeUpdate($sql);
	}
	else if($_POST['Active']!=''){
		$sql="update yp_news set status= 'Active' where rec_id in ('$str_ids') " ;	
		executeUpdate($sql);
	}
	else if($_POST['Inactive']!=''){
		$sql="update yp_news set status= 'Inactive' where rec_id in ('$str_ids') " ;	
		executeUpdate($sql);
	}else if($_POST['Feature']!=''){
		$sql="update yp_news set feature_status='Yes' where rec_id in ('$str_ids') " ;	
		executeUpdate($sql);
	}
	else if($_POST['Unfeature']!=''){
		$sql="update yp_news set feature_status='No' where rec_id in ('$str_ids') " ;	
		executeUpdate($sql);
	}
}


header("Location: news_list.php?start=$start");
exit;

?>