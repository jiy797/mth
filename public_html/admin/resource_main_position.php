<?php

require "./includes/application_top.php";

$admin_id=$_SESSION['admin_id'];
if ($admin_id=="")
{
	header("Location:index.php");
	exit();
}

$rec_id		= $_GET['id'];
$postion	= $_GET['pos'];
$type		= $_GET['type'];
$start		= $_GET['start'];
$return		= $_GET['return'];

//echo "<pre>";
//print_r($_GET);
//echo "</pre>";
//exit();
if($rec_id!=""){
	if($type=="up"){
		if($postion>1){
			$prev_postion=$postion-1;
//			echo "<br>pre--$prev_postion<br>";
			$sql="select rec_id from yp_resource_main where rec_position=$prev_postion";
//			echo "<br>$sql<br>";
			$id=getSingleResult($sql);
//			echo "<br>id---$id<br>";
//			exit();
			if($id!=""){
				$sql="update yp_resource_main set rec_position=$postion where rec_id=$id";
				executeQuery($sql);
				$sql="update yp_resource_main set rec_position=$prev_postion where rec_id=$rec_id";
				executeQuery($sql);
			}
		}
	}else if($type=="down"){
		$sql="select max(rec_position) from yp_resource_main";
		$max_postion=getSingleResult($sql);
		if($postion<$max_postion){
			$next_postion=$postion+1;
			$sql="select rec_id from yp_resource_main where rec_position=$next_postion";
			$id=getSingleResult($sql);
			if($id!=""){
				$sql="update yp_resource_main set rec_position=$postion where rec_id=$id";
				executeQuery($sql);
				$sql="update yp_resource_main set rec_position=$next_postion where rec_id=$rec_id";
				executeQuery($sql);
			}
		}
	}
}


header("Location: resource_main_list.php?start=$start");
exit;
?>