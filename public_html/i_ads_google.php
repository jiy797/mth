<?php
	$sql_lgban="select * from yp_banner_left where status='Active' order by rand() limit 0, 1";
	$res_lgban=executeQuery($sql_lgban);
?>

<?php while($line_lgban=mysql_fetch_array($res_lgban)){?>
		<?php echo stripslashes($line_lgban['b_code']); ?>
	<img src="<?php echo $non_secure_path?>images/blank.gif" width="1" height="15" alt="" />
<?php }?>