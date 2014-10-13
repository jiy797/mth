<?php

require "./includes/application_top.php";

$admin_id=$_SESSION['admin_id'];
if ($admin_id=="")
{
	header("Location:index.php");
	exit();
}

$link_id	= $_GET['id'];
$postion	= $_GET['pos'];
$type		= $_GET['type'];
$start		= $_GET['start'];
$return		= $_GET['return'];

//echo "<pre>";
//print_r($_GET);
//echo "</pre>";
//exit();
if($link_id!=""){
	if($type=="up"){
		if($postion>1){
			$prev_postion=$postion-1;
//			echo "<br>pre--$prev_postion<br>";
			$sql="select link_id from yp_links where link_position=$prev_postion";
//			echo "<br>$sql<br>";
			$id=getSingleResult($sql);
//			echo "<br>id---$id<br>";
//			exit();
			if($id!=""){
				$sql="update yp_links set link_position=$postion where link_id=$id";
				executeQuery($sql);
				$sql="update yp_links set link_position=$prev_postion where link_id=$link_id";
				executeQuery($sql);
			}
		}
	}else if($type=="down"){
		$sql="select max(link_position) from yp_links";
		$max_postion=getSingleResult($sql);
		if($postion<$max_postion){
			$next_postion=$postion+1;
			$sql="select link_id from yp_links where link_position=$next_postion";
			$id=getSingleResult($sql);
			if($id!=""){
				$sql="update yp_links set link_position=$postion where link_id=$id";
				executeQuery($sql);
				$sql="update yp_links set link_position=$next_postion where link_id=$link_id";
				executeQuery($sql);
			}
		}
	}
}


header("Location: link_list.php?start=$start");
exit;
?>