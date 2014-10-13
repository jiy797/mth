<?php
	$sql_bban="select * from yp_banner_bottom where b_page='".$b_page."' and status='Active' order by rand() limit 0, 1";
	$res_bban=executeQuery($sql_bban);
?>
<div class="banner" align="center" style="padding-bottom:10px; padding-top:5px;">

<?php while($line_bban=mysql_fetch_array($res_bban)){?>
	<?php if($line_bban['b_type']=='Image'){?>
		<a href="http://<?php echo $line_bban['b_link']?>" target="_blank"><img src="<?php echo $non_secure_path?>uploadedfiles/banner/<?php echo $line_bban['b_img']?>" width="728" height="90" alt="<?php echo $b_page?>" border="0"/></a>
	<?php }?>
	
	<?php if($line_bban['b_type']=='Code'){?>
		<?php echo stripslashes($line_bban['b_code']); ?>
	<?php }?>

<?php }?>

</div>