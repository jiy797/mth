<?php
	$sql_tban="select * from yp_banner_top where b_page='".$b_page."' and status='Active' order by rand() limit 0, 1";
	$res_tban=executeQuery($sql_tban);
?>

<?php while($line_tban=mysql_fetch_array($res_tban)){?>
	<?php if($line_tban['b_type']=='Image'){?>
		<a href="http://<?php echo $line_tban['b_link']?>" target="_blank"><img src="<?php echo $non_secure_path?>uploadedfiles/banner/<?php echo $line_tban['b_img']?>" width="728" height="90" alt="<?php echo $b_page?>" border="0"/></a>
	<?php }?>
	
	<?php if($line_tban['b_type']=='Code'){?>
		<?php echo stripslashes($line_tban['b_code']); ?>
	<?php }?>

<?php }?>

