<?php

$start=0;
if(isset($_GET['start'])){	$start=$_GET['start'];}
$pagesize=20;
$pagecounter=0;
if(isset($_GET['pagesize']))
{
	$pagesize=$_GET['pagesize'];
	$pagesize=intval($pagesize);
	if(intval($pagesize)==0)
	{	
		header("Location: ".$_SERVER['PHP_SELF']);
		exit;
	}
}

if($_SESSION['sess_order_by']==$order_by)
{
	if($_SESSION['order_by2']=='asc')
	{
		$order_by2='desc';
	}
	else
	{
		$order_by2='asc';
	}
}

if($order_by2=='')
{
	$order_by2='desc';
}

if($order_by=='')
{
	$order_by='cat_name';
}

$_SESSION['order_by2']=$order_by2;
$_SESSION['sess_order_by']=$order_by;

$columns="select * ";
$sql_lrcat=" from yp_learning where cat_id='$cid' and status='Active' ";

$sql1="select count(*) ".$sql_lrcat;
$sql_lrcat.= " order by rec_position";
$sql_lrcat.= " limit $start, $pagesize";

$sql_lrcat= $columns.$sql_lrcat;
$res_lrcat= executeQuery($sql_lrcat);

$reccnt = getSingleResult($sql1);	



$sql_cname="select cat_name from yp_learning_category where cat_id='$cid'";
$lrcat_name=getSingleResult($sql_cname);

?>

<div class="fl" style="font-size:14px"><b><?php echo stripslashes($lrcat_name)?></b></div>
<div class="fr" class="smaller"><!--<a href="#">SEE ALL</a>--></div>
<div class="clear"></div>
<img src="<?php echo $non_secure_path?>images/blank.gif" width="1" height="10" alt="" /><br/>

<?php while($line_lrcat=mysql_fetch_array($res_lrcat)){ 
		$ar_name=stripslashes($line_lrcat['rec_name']);
		$ar_name=strtolower($ar_name);
		$ar_name=str_replace(' ','-',$ar_name);
?>
	<a href="<?php echo $non_secure_path."learning/".$line_lrcat['rec_id']?>/<?php echo $ar_name?>/"><?php echo stripslashes($line_lrcat['rec_name'])?></a>
	<div class="date1"><?php echo getFullDate($line_lrcat['rec_date'],'m.d.Y')?></div>
	<?php echo stripslashes(substr($line_lrcat['rec_desc'],0,150))?>...<br/>
	<div class="dividero"><!--  --></div>
<?php }?>

<?php if($reccnt>20){?>
	<table width="100%" cellpadding="0" cellspacing="0">
		<tr>
			<td height="40" align="center" class="main"><?php include "./includes/prev_paging_next.inc.php";?></td>
		</tr>
	</table>
<?php }?>

