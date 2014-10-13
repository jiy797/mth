<?php

$start=0;
if(isset($_GET['start'])){	$start=$_GET['start'];}
$pagesize=10;
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
	$order_by='rec_name';
}

$_SESSION['order_by2']=$order_by2;
$_SESSION['sess_order_by']=$order_by;

$columns="select * ";
$sql_fpro=" from yp_provider where status='Active' ";

$sql1="select count(*) ".$sql_fpro;
$sql_fpro.= " order by rec_position";
$sql_fpro.= " limit $start, $pagesize";

$sql_fpro= $columns.$sql_fpro;
$res_fpro= executeQuery($sql_fpro);

$reccnt = getSingleResult($sql1);	

//$sql_fpro="select * from yp_provider where status='Active' order by rec_name";
//$res_fpro=executeQuery($sql_fpro);

$divclass="box2";
?>

<?php if(mysql_num_rows($res_fpro)){?>
<h5>Featured Providers</h5>

<?php if($reccnt>10){?>
<table width="100%" cellpadding="0" cellspacing="0">
	<tr>
		<td align="center" class="main"><?php include "./includes/rev_paging_next.inc.php";?></td>
	</tr>
</table>
<?php }?>

<?php while($lin_fpro=mysql_fetch_array($res_fpro)){
		$pagecounter+=l;
		if($divclass=="box2"){
			$divclass="box1";
		}else{
			$divclass="box2";
		}
?>

<div class="<?php echo $divclass?>">
	<table cellpadding="0" cellspacing="0" class="entry" width="100%">
	  <tr>
		<td width="144"><a href="<?php echo $non_secure_path."provider/".$lin_fpro['rec_id']?>/"><?php if($lin_fpro['rec_img']!=''){?><img src="./uploadedfiles/real/<?php echo $lin_fpro['rec_img']?>" alt="" border="0" /><?php }else{?><img src="images/proNoImage.jpg" border="0" /><?php }?></a></td>
		<td>
			<div class="fl" style="width:500px;">
			<a href="<?php echo $non_secure_path."provider/".$lin_fpro['rec_id']?>/"><?php echo stripslashes($lin_fpro['rec_name'])?></a><br/>
			<?php echo stripslashes(substr($lin_fpro['rec_desc'],0,190))?>...<br/>
			<?php if($lin_fpro['rec_url']!=''&&$lin_fpro['rec_ori_url']!=''){?>
			<div class="linky"><a href="http://<?php echo $lin_fpro['rec_ori_url']?>" target="_blank"><?php echo $lin_fpro['rec_url']?></a></div>
			<?php }?>
			</div>
			<div class="fr" align="right">
			<?php $avg_rating = averageRating($lin_fpro['rec_id']); ?>
			<?php for($ictr=0;$ictr<$avg_rating;$ictr++){?>
			<img src="images/star.png" width="12" height="11" alt="" />
			<?php }?>
			<br/><div class="smaller"><a href="<?php echo $non_secure_path."prodet/".$lin_fpro['rec_id']?>/ovew/">Overview</a><br/><a href="<?php echo $non_secure_path."prodet/".$lin_fpro['rec_id']?>/faq/">FAQ</a><br/><a href="<?php echo $non_secure_path."prodet/".$lin_fpro['rec_id']?>/rev/">Read Reviews</a></div></div>
			<div class="clear"></div>
		</td>
	  </tr>
	</table>
</div>
<?php } //while ends?>


<?php if($reccnt>10){?>
<table width="100%" cellpadding="0" cellspacing="0">
	<tr>
		<td align="center" class="main"><?php include "./includes/rev_paging_next.inc.php";?></td>
	</tr>
</table>
<?php }?>


<?php } //if ends?>
