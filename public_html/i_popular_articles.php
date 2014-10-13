<?php
	$sql_newsp="select * from yp_mtb where status='Active' and feature_status='Yes' order by rec_position desc limit 0, 4";
	$res_newsp=executeQuery($sql_newsp);
?>

<?php if(mysql_num_rows($res_newsp)>0){ ?>
<h5>Popular Articles</h5>

  <table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
	  <td><table width="100%" border="0" cellpadding="0" cellspacing="0">
	<?php 

  $rows=0;
	$cols=2;
	$j=0;

	$form_no=1;

	while($lin_newsp=mysql_fetch_array($res_newsp)){
			$pagecounter+=1;

			$ar_name=stripslashes($lin_newsp['rec_name']);
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
		<td valign="top" align="left"><div style="border-bottom:1px solid #dbdbdb; padding-top:10px; margin-bottom:10px;"><!--  --></div>
			<table width="100%" cellpadding="2" cellspacing="2">
			 <tr>
			   <td valign="top">
					<a href="<?php echo $non_secure_path."mtb/".$lin_newsp['rec_id']?>/<?php echo $ar_name?>/"><?php echo stripslashes($lin_newsp['rec_name'])?></a>
					<br/>
				    <?php echo stripslashes(substr($lin_newsp['rec_desc'],0,100))?>...<br/>
			   </td>
			</tr>
		</table></td>
	<?php 
		$rows++;
		$form_no++;
		
	}//end while

	?>
	  </tr>
  </table></td>
</tr>
</table>

<div class="dividero"><!--  --></div>
<div align="right"><a href="mtb-see-all.php">More Articles >></a></div>

 <?php }?>
 

