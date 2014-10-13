<?php
	$sql_i1ban="select * from yp_banner_right where b_page='".$b_page."' and status='Active' order by rand() limit 0, 1";
	$res_i1ban=executeQuery($sql_i1ban);
?>

<?php while($line_i1ban=mysql_fetch_array($res_i1ban)){?>

	<?php if($line_i1ban['b_type']=='Image'){?>
		<a href="http://<?php echo $line_i1ban['b_link']?>" target="_blank"><img src="<?php echo $non_secure_path?>uploadedfiles/banner/<?php echo $line_i1ban['b_img']?>" width="300" height="250" alt="INDEX" border="0"/></a>
	<?php }?>
	
	<?php if($line_i1ban['b_type']=='Code'){?>
		<?php echo stripslashes($line_i1ban['b_code']); ?>
	<?php }?>
	<br/>
	<img src="<?php echo $non_secure_path?>images/blank.gif" width="1" height="15" alt="" />
<?php }?>