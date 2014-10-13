<?php
	$sql_mtb="select * from yp_learning where status='Active' and feature_status='Yes' order by rec_position limit 0,5";
	$res_mtb=executeQuery($sql_mtb);
?>
<div><img src="<?php echo $non_secure_path?>images/box1_01.jpg" width="160" height="6" alt="" /></div>
<div class="boxbody" style="padding-top:6px; padding-bottom:6px;">
	<table cellpadding="0" cellspacing="0">
	  <tr>
		<td valign="top"><img src="<?php echo $non_secure_path?>images/questionmark.gif" width="19" height="25" alt="" /></td>
		<td width="6"></td>
		<td><a href="<?php echo $non_secure_path?>learning-center.php"><h6>Money Transfer Basics</h6></a></td>
	  </tr>
	</table>
	<img src="<?php echo $non_secure_path?>images/blank.gif" width="1" height="8" alt="" /><br/>
	<ul>
		<?php while($lin_mtb=mysql_fetch_array($res_mtb)){
				$ar_name=stripslashes($lin_mtb['rec_name']);
				$ar_name=strtolower($ar_name);
				$ar_name=str_replace(' ','-',$ar_name);
		?>
			<li><a href="<?php echo $non_secure_path."learning/".$lin_mtb['rec_id']?>/<?php echo $ar_name?>/"><?php echo stripslashes($lin_mtb['rec_name'])?></a></li>
		<?php }?>
	</ul>
</div>
<div style="padding-bottom:10px;"><img src="<?php echo $non_secure_path?>images/box1_03.jpg" width="160" height="7" alt="" /></div>
