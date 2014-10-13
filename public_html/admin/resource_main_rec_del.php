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


$id     = $_GET['id'];
$start  = $_GET['start'];

if($id!=''){

	//---------------- DELETE PDF -----------------------------
	
	$sql_gal="select * from yp_resource_main where rec_id='$id'" ;
	$res_gal=executeQuery($sql_gal);

	while($line_gal=mysql_fetch_array($res_gal)){
		$rec_img = $line_gal['rec_img'];
		@unlink("../uploadedfiles/real/".$rec_img);
		
	}
	

	//------------- DELETE RECORDS ---------------------------------------


		$sql="select * from yp_resource_main where rec_id='$id'";
		$result=executeQuery($sql);

		while($line=mysql_fetch_array($result)){
			$rec_id	      = $line['rec_id'];
			$rec_position = $line['rec_position'];

			$sql_lp="select * from yp_resource_main where rec_position>'$rec_position' order by rec_position asc";
			$res_lp=executeQuery($sql_lp);

			while($lin_lp=mysql_fetch_array($res_lp)){
				$rec_id		  = $lin_lp['rec_id'];
				$rec_position = $lin_lp['rec_position'];

				$new_rec_position = $rec_position-1;

				$sql_up="update yp_resource_main set rec_position='$new_rec_position' where rec_id='$rec_id'";
				executeUpdate($sql_up);
			
			}
			
			$sql_del="delete from yp_resource_main where rec_id='".$line['rec_id']."'" ;	
			executeQuery($sql_del);
		}

	//---------------------------------------------------------------


	$sql="delete from yp_resource_main where rec_id='$id'" ;
	executeUpdate($sql);


}		

header("Location: resource_main_list.php?start=$start");
exit;

?>