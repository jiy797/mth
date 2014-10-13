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
	$order_by='rec_name';
}

$_SESSION['order_by2']=$order_by2;
$_SESSION['sess_order_by']=$order_by;

$columns="select * ";
$sql_rsmain=" from yp_resource_main where status='Active' ";

$sql1="select count(*) ".$sql_rsmain;
$sql_rsmain.= " order by rec_position";
$sql_rsmain.= " limit $start, $pagesize";

$sql_rsmain= $columns.$sql_rsmain;
$res_rsmain= executeQuery($sql_rsmain);

$reccnt = getSingleResult($sql1);	


//$sql_rsmain="select * from yp_news_category where status='Active' order by rec_name";
//$res_rsmain=executeQuery($sql_rsmain);

?>

<?php if(mysql_num_rows($res_rsmain)>0){ ?>
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
	  <td><table width="100%" border="0" cellpadding="0" cellspacing="0">
		<?php 

		$rows=0;
		$cols=4;
		$j=0;

		$form_no=1;

		while($line_rsmain=mysql_fetch_array($res_rsmain)){
				$pagecounter+=1;

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
		<td valign="top" width="20%" align="left"><div style="border-bottom:1px sonid #dbdbdb; padding-top:10px; margin-bottom:10px;"><!--  --></div>
			<table width="100%" cellpadding="2" cellspacing="2">
			  <tr>
				<td align="center"><a href="resources-list1.php?rsid=<?php echo $line_rsmain['rec_id']?>"><img src="./uploadedfiles/real/<?php echo $line_rsmain['rec_img']?>" border="0"></a></td>
			  </tr>
			  <tr>
				<td align="center"><a href="resources-list1.php?rsid=<?php echo $line_rsmain['rec_id']?>"><?php echo stripslashes($line_rsmain['rec_name'])?></a></td>
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
		 <?php if($reccnt>20){?>
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
 
 
 