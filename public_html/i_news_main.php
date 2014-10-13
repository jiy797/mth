<?php

$start=0;
if(isset($_GET['start'])){	$start=$_GET['start'];}
$pagesize=8;
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
$sql_lrcat=" from yp_news_category where status='Active' ";

$sql1="select count(*) ".$sql_lrcat;
$sql_lrcat.= " order by cat_name";
$sql_lrcat.= " limit $start, $pagesize";

$sql_lrcat= $columns.$sql_lrcat;
$res_lrcat= executeQuery($sql_lrcat);

$reccnt = getSingleResult($sql1);	


//$sql_lrcat="select * from yp_news_category where status='Active' order by cat_name";
//$res_lrcat=executeQuery($sql_lrcat);

?>

<?php if(mysql_num_rows($res_lrcat)>0){ ?>
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
	  <td><table width="100%" border="0" cellpadding="0" cellspacing="0">
		<?php 

		$rows=0;
		$cols=2;
		$j=0;

		$form_no=1;

		while($line_lrcat=mysql_fetch_array($res_lrcat)){
				$pagecounter+=1;

			$sql_a_chk="select count(*) from yp_news where cat_id='".$line_lrcat['cat_id']."' and status='Active'";
			$res_a_chk=getSingleResult($sql_a_chk);

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
		<?php if($res_a_chk>0){?>
		<td valign="top" width="50%" align="left"><div style="border-bottom:1px sonid #dbdbdb; padding-top:10px; margin-bottom:10px;"><!--  --></div>
			<table width="100%" cellpadding="2" cellspacing="2">
			 <tr>
			   <td valign="top">
				  <div class="fl" style="font-size:14px"><b><?php echo stripslashes($line_lrcat['cat_name'])?></b></div>
				  <div class="clear"></div>
				  <img src="images/blank.gif" width="1" height="10" alt="" /><br/>
				  <?php if($res_a_chk>0){?>
				  <a href="news-see-all.php?cid=<?php echo $line_lrcat['cat_id']?>"><span class="red">&raquo;See All</span></a>
				  <br/>
				  <?php }?>
				  <?php
						$sql_lrar="select * from yp_news where cat_id='".$line_lrcat['cat_id']."' and status='Active' and feature_status='Yes' order by rec_position limit 0,6";
						$res_lrar=executeQuery($sql_lrar);
				  ?>
				  <?php while($line_lrar=mysql_fetch_array($res_lrar)){ 
					  		$ar_name=stripslashes($line_lrar['rec_name']);
							$ar_name=strtolower($ar_name);
							$ar_name=str_replace(' ','-',$ar_name);

				  ?>
					  <a href="<?php echo $non_secure_path."new/".$line_lrar['rec_id']?>/<?php echo $ar_name?>/"><?php echo stripslashes($line_lrar['rec_name'])?></a><br/>
				  <?php }?>
			   </td>
			</tr>
		</table>
		</td>

		<?php }//end if?>
	<?php 
		$rows++;
		$form_no++;
		
	}//end while

	?>
	  </tr>
		  <tr>
			<td colspan="2">&nbsp;</td>
		  </tr>
		 <?php if($reccnt>8){?>
		  <tr>
			<td  colspan="2" height="40" align="center" class="main"><?php include "./includes/prev_paging_next.inc.php";?></td>
		 </tr> 
		 <?php }?>

  </table></td>
</tr>
</table>
 <?php }else{?>

 <table width="100%" cellpadding="0" cellspacing="0">
  <tr>
	<td height="40" align="center" class="red">Coming Soon....</td>
 </tr> 
 </table>
 <?php }?>