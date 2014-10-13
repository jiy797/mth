<?php

$start=0;
if(isset($_GET['start'])){	$start=$_GET['start'];}
$pagesize=6;
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
$sql_lrnr=" from yp_news where cat_id='$rec_cat_id' and rec_id<>'$nid' and status='Active' ";

$sql1="select count(*) ".$sql_lrnr;
$sql_lrnr.= " order by rec_date desc";
$sql_lrnr.= " limit $start, $pagesize";

$sql_lrnr= $columns.$sql_lrnr;
$res_lrnr= executeQuery($sql_lrnr);

$reccnt = getSingleResult($sql1);	

//$sql_lrnr="select * from yp_news where cat_id='$rec_cat_id' and rec_id<>'$nid' order by rec_position";
//$res_lrnr=executeQuery($sql_lrnr);

?>

<?php if(mysql_num_rows($res_lrnr)>0){ ?>
<h1 style="margin-bottom:6px; padding:0px;">Related Articles</h1>

  <table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
	  <td><table width="100%" border="0" cellpadding="0" cellspacing="0">
	<?php 

	$rows=0;
	$cols=2;
	$j=0;

	$form_no=1;

	while($lin_lrnr=mysql_fetch_array($res_lrnr)){
			$pagecounter+=1;
			$ar_name=stripslashes($lin_lrnr['rec_name']);
			$ar_name=strtolower($ar_name);
			$ar_name=str_replace(' ','-',$ar_name);

		if($rows==0) echo "<tr>";
		if($rows%$cols==0){ 
			echo "</tr>";
			if($rows!=0){?>
		  <tr>
			<td colspan='<?php echo $cols?>' height='10'></td>
		  </tr>
		  <tr>
			<?php }else{
				echo "<tr>";
			}
		}
	?>
		<td valign="top" width="50%" align="left"><div style="border-bottom:1px sonid #dbdbdb; padding-top:10px; margin-bottom:10px;"><!--  --></div>
			<table width="100%" cellpadding="2" cellspacing="2">
			 <tr>
			   <td valign="top">
				  <a href="<?php echo $non_secure_path."new/".$lin_lrnr['rec_id']."/".$ar_name."/"?>"><b><?php echo stripslashes($lin_lrnr['rec_name'])?></b></a><br/>
				  <div class="date1"><?php echo getFullDate($lin_lrnr['rec_date'],'m.d.Y')?></div>
				  <?php echo stripslashes(substr($lin_lrnr['rec_desc'],0,75))?>...<br/>
			   </td>
			</tr>
		</table></td>
	<?php 
		$rows++;
		$form_no++;
		
	}//end while

	?>
	  </tr>
		  <tr>
			<td colspan="2">&nbsp;</td>
		  </tr>
		 <?php if($reccnt>6){?>
		  <tr>
			<td  colspan="2" height="40" align="center" class="main"><?php include "./includes/prev_paging_next.inc.php";?></td>
		 </tr> 
		 <?php }?>


  </table></td>
</tr>
</table>

 <?php }?>