<link href="css/yp.css" rel="stylesheet" type="text/css" />
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  
  <tr>
    <td class="brown_bar" ><br />
		<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
              <td class="heading">
                <?php echo $site_title;?>
                <BR>
                <span class="orange_text"> Administration Panel powered by Visuwire</span></td>
              <td width="100"></td>
              <td width="220" align="right" class="para_title">
				<span class="orange_text">
				<?php 
				if($admin_id==''){?>Welcome to, <B>
                <?php echo $site_title;?>
                </b> site management panel...<?php }else{?>Welcome <b><?php echo $admin_id;?></b>,<?php }?><BR>
                <BR style="line-height:6px">
                <?php if($admin_id==''){?>
				</span><span class="para_heading">Please Login</span><span class="orange_text">
				<?php }else {?>
				<a href="logout.php"><img src="images/logout.jpg" width="92" height="24" border="0"></a>
				<?php }?>
                </span></td>
            </tr>
      </table>
		<br />
    </td>
  </tr>
  <tr>
    <td class="orange_bar"><img src="images/spacer.gif" width="10" height="1"></td>
  </tr>
</table>
