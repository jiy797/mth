<?php
	$sql_fpro="select * from yp_provider where status='Active' and feature_status='Yes' order by rec_position limit 0, 4";
	$res_fpro=executeQuery($sql_fpro);

	$divclass="box2";
?>

<?php if(mysql_num_rows($res_fpro)){?>
<h5>Featured Providers</h5>

<?php while($lin_fpro=mysql_fetch_array($res_fpro)){
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
			<a href="<?php echo $non_secure_path."provider/".$lin_fpro['rec_id']?>/"><?php echo stripslashes($lin_fpro['rec_name'])?></a><br/>
			<?php echo stripslashes(substr($lin_fpro['rec_desc'],0,100))?>...<br/>
			<img src="images/blank.gif" width="1" height="8" alt="" /><br/>
			<?php $avg_rating = averageRating($lin_fpro['rec_id']); ?>
			<?php for($ictr=0;$ictr<$avg_rating;$ictr++){?>
			<img src="images/star.png" width="12" height="11" alt="" />
			<?php }?>
			<br/>
		</td>
		<td width="15">
			<a href="#"></a><br/>
			<img src="images/blank.gif" width="1" height="8" alt="" /><br/>

		</td>
	  </tr>
	</table>
</div>

<?php } //while ends?>

<?php } //if ends?>



<div class="dividero"><!--  --></div>

<div align="right"><a href="reviews.php">See Other Providers >></a></div>