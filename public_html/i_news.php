<?php
	$sql_fn1="select * from yp_news where status='Active' and feature_status='Yes' order by rec_position desc limit 0,4";
	$res_fn1=executeQuery($sql_fn1);
?>
<div><img src="<?php echo $non_secure_path?>images/news-top.jpg" width="300" height="6" alt="" /></div>
<div class="newsbody1" style="padding-top:3px; padding-bottom:16px; margin-bottom:10px;">
	<div class="fl" style="padding-top:3px;"><img src="<?php echo $non_secure_path?>images/news.png" width="14" height="16" alt=""/>&nbsp;</div>
	<div class="fl"><a href="<?php echo $non_secure_path?>news.php"><h4>News Articles</h4></a></div>
	<div class="clear"></div>

	<?php while($lin_fn1=mysql_fetch_array($res_fn1)){
			$ar_name=stripslashes($lin_fn1['rec_name']);
			$ar_name=strtolower($ar_name);
			$ar_name=str_replace(' ','-',$ar_name);
	?>
	<div class="date" style="margin-bottom:0px; padding:0px;"><?php echo getFullDate($lin_fn1['rec_date'],'m.d.y')?></div>
	<div class="news" style="margin-top:0px"><a href="<?php echo $non_secure_path."new/".$lin_fn1['rec_id']?>/<?php echo $ar_name?>/"><b><?php echo stripslashes($lin_fn1['rec_name'])?></b></a>
	<?php echo stripslashes(substr($lin_fn1['rec_desc'],0,90))?>...</div>
	<div class="dividero"><!--  --></div>
	<?php }?>

	
	<div style="font-size:11px;"><a href="<?php echo $non_secure_path?>news.php">More News >></a></div>
</div>