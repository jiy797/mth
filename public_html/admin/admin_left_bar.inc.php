<?php
	if($_GET['op']!=''){
		$_SESSION['sess_op']		=	$_GET['op'];
	}

?>
<link href="css/yp.css" rel="stylesheet" type="text/css" />
<table width="100%" border="0" cellpadding="0" cellspacing="0"  class="brown_bar">

  <tr>
    <td height="20" colspan="3" class="blue_bar"><a href="content_page_list.php?op=Contents"><span class="blue_bar">&nbsp;Manage Static Contents</span></a></td>
  </tr>
   <?php if($_SESSION['sess_op']=="Contents"){?>
  <tr>
    <td colspan="3" bgcolor="#FFFFFF"><img src="images/spacer.gif" width="1" height="1" /></td>
  </tr>
  <tr>
    <td  height="20" colspan="3" >&nbsp;&nbsp;&nbsp;&nbsp;<a href="content_page_list.php" class="menu_white">Content Page List</a></td>
  </tr>
  <tr>
    <td colspan="3" bgcolor="#FFFFFF"><img src="images/spacer.gif" width="1" height="1" /></td>
  </tr>
  <tr>
    <td  height="20" colspan="3" >&nbsp;&nbsp;&nbsp;&nbsp;<a href="new_page_list.php" class="menu_white">New Page List</a></td>
  </tr>
  <tr>
    <td colspan="3" bgcolor="#FFFFFF"><img src="images/spacer.gif" width="1" height="1" /></td>
  </tr>
  <tr>
    <td height="20" colspan="3" >&nbsp;&nbsp;&nbsp;&nbsp;<a href="c_address_frm.php" class="menu_white">Contact Page</a></td>
  </tr>
  <tr>
    <td colspan="3" bgcolor="#FFFFFF"><img src="images/spacer.gif" width="1" height="1" /></td>
  </tr>
  <tr>
    <td height="20" colspan="3" >&nbsp;&nbsp;&nbsp;&nbsp;<a href="site_down_frm.php" class="menu_white">Site Down Page</a></td>
  </tr>
  <?php }?>

  <tr>
    <td colspan="3" bgcolor="#FFFFFF"><img src="images/spacer.gif" width="1" height="1" /></td>
  </tr>
  <tr>
    <td height="20" colspan="3" class="blue_bar">&nbsp;<a href="provider_list.php?op=mngprvd"><span class="blue_bar">Manage Provider</span></a></td>
  </tr>
  <?php if($_SESSION['sess_op']=="mngprvd"){?>
  <tr>
    <td colspan="3" bgcolor="#FFFFFF"><img src="images/spacer.gif" width="1" height="1" /></td>
  </tr>
  <tr>
    <td colspan="3"  height="20">&nbsp;&nbsp;&nbsp;&nbsp;<a href="provider_list.php" class="menu_white">Provider List</a></td>
  </tr> 
  <tr>
    <td colspan="3" bgcolor="#FFFFFF"><img src="images/spacer.gif" width="1" height="1" /></td>
  </tr>
  <tr>
    <td colspan="3"  height="20">&nbsp;&nbsp;&nbsp;&nbsp;<a href="compare_category_list.php" class="menu_white">Compare Category</a></td>
  </tr> 
  <?php }?>
 
  <tr>
    <td colspan="3" bgcolor="#FFFFFF"><img src="images/spacer.gif" width="1" height="1" /></td>
  </tr>
  <tr>
    <td height="20" colspan="3" class="blue_bar">&nbsp;<a href="mtb_category_list.php?op=mngmtb"><span class="blue_bar">Manage Articles</span></a></td>
  </tr>
  <?php if($_SESSION['sess_op']=="mngmtb"){?>
  <tr>
    <td colspan="3" bgcolor="#FFFFFF"><img src="images/spacer.gif" width="1" height="1" /></td>
  </tr>
  <tr>
    <td colspan="3"  height="20">&nbsp;&nbsp;&nbsp;&nbsp;<a href="mtb_category_list.php" class="menu_white">Category List</a></td>
  </tr> 
  <tr>
    <td colspan="3" bgcolor="#FFFFFF"><img src="images/spacer.gif" width="1" height="1" /></td>
  </tr>
  <tr>
    <td colspan="3"  height="20">&nbsp;&nbsp;&nbsp;&nbsp;<a href="mtb_list.php" class="menu_white">Article List</a></td>
  </tr> 
  <?php }?>

  <tr>
    <td colspan="3" bgcolor="#FFFFFF"><img src="images/spacer.gif" width="1" height="1" /></td>
  </tr>
  <tr>
    <td height="20" colspan="3" class="blue_bar">&nbsp;<a href="learning_category_list.php?op=mnglrn"><span class="blue_bar">Manage Learning Center</span></a></td>
  </tr>
  <?php if($_SESSION['sess_op']=="mnglrn"){?>
  <tr>
    <td colspan="3" bgcolor="#FFFFFF"><img src="images/spacer.gif" width="1" height="1" /></td>
  </tr>
  <tr>
    <td colspan="3"  height="20">&nbsp;&nbsp;&nbsp;&nbsp;<a href="learning_category_list.php" class="menu_white">Category List</a></td>
  </tr> 
  <tr>
    <td colspan="3" bgcolor="#FFFFFF"><img src="images/spacer.gif" width="1" height="1" /></td>
  </tr>
  <tr>
    <td colspan="3"  height="20">&nbsp;&nbsp;&nbsp;&nbsp;<a href="learning_list.php" class="menu_white">Article List</a></td>
  </tr> 
  <?php }?>

  <tr>
    <td colspan="3" bgcolor="#FFFFFF"><img src="images/spacer.gif" width="1" height="1" /></td>
  </tr>
  <tr>
    <td height="20" colspan="3" class="blue_bar">&nbsp;<a href="resource_main_list.php?op=mngres"><span class="blue_bar">Manage Resources</span></a></td>
  </tr>
  <?php if($_SESSION['sess_op']=="mngres"){?>
  <tr>
    <td colspan="3" bgcolor="#FFFFFF"><img src="images/spacer.gif" width="1" height="1" /></td>
  </tr>
  <tr>
    <td colspan="3"  height="20">&nbsp;&nbsp;&nbsp;&nbsp;<a href="resource_main_list.php" class="menu_white">Resource List</a></td>
  </tr> 
  <tr>
    <td colspan="3" bgcolor="#FFFFFF"><img src="images/spacer.gif" width="1" height="1" /></td>
  </tr>
  <tr>
    <td colspan="3"  height="20">&nbsp;&nbsp;&nbsp;&nbsp;<a href="banks_list.php" class="menu_white">Bank List</a></td>
  </tr> 
  <tr>
    <td colspan="3" bgcolor="#FFFFFF"><img src="images/spacer.gif" width="1" height="1" /></td>
  </tr>
  <tr>
    <td colspan="3"  height="20">&nbsp;&nbsp;&nbsp;&nbsp;<a href="tablea_list.php" class="menu_white">Table A [Transfer From Country]</a></td>
  </tr> 
  <tr>
    <td colspan="3" bgcolor="#FFFFFF"><img src="images/spacer.gif" width="1" height="1" /></td>
  </tr>
  <tr>
    <td colspan="3"  height="20">&nbsp;&nbsp;&nbsp;&nbsp;<a href="tableb_list.php" class="menu_white">Table B [Transfer To Country]</a></td>
  </tr> 
  <tr>
    <td colspan="3" bgcolor="#FFFFFF"><img src="images/spacer.gif" width="1" height="1" /></td>
  </tr>
  <tr>
    <td colspan="3"  height="20">&nbsp;&nbsp;&nbsp;&nbsp;<a href="tablec_list.php" class="menu_white">Table C [Sending Bank]</a></td>
  </tr> 
  <tr>
    <td colspan="3" bgcolor="#FFFFFF"><img src="images/spacer.gif" width="1" height="1" /></td>
  </tr>
  <tr>
    <td colspan="3"  height="20">&nbsp;&nbsp;&nbsp;&nbsp;<a href="tabled_list.php" class="menu_white">Table D [Receiving Bank]</a></td>
  </tr> 
  <!--   
  <tr>
    <td colspan="3" bgcolor="#FFFFFF"><img src="images/spacer.gif" width="1" height="1" /></td>
  </tr>
  <tr>
    <td colspan="3"  height="20">&nbsp;&nbsp;&nbsp;&nbsp;<a href="resource_category_list.php" class="menu_white">Options List</a></td>
  </tr> 
  <tr>
    <td colspan="3" bgcolor="#FFFFFF"><img src="images/spacer.gif" width="1" height="1" /></td>
  </tr>
  <tr>
    <td colspan="3"  height="20">&nbsp;&nbsp;&nbsp;&nbsp;<a href="resource_list.php" class="menu_white">Article List</a></td>
  </tr>  
  -->
  <?php }?>


  <tr>
    <td colspan="3" bgcolor="#FFFFFF"><img src="images/spacer.gif" width="1" height="1" /></td>
  </tr>
  <tr>
    <td height="20" colspan="3" class="blue_bar">&nbsp;<a href="news_category_list.php?op=mngnews"><span class="blue_bar">Manage News</span></a></td>
  </tr>
  <?php if($_SESSION['sess_op']=="mngnews"){?>
  <tr>
    <td colspan="3" bgcolor="#FFFFFF"><img src="images/spacer.gif" width="1" height="1" /></td>
  </tr>
  <tr>
    <td colspan="3"  height="20">&nbsp;&nbsp;&nbsp;&nbsp;<a href="news_category_list.php" class="menu_white">Category List</a></td>
  </tr> 
  <tr>
    <td colspan="3" bgcolor="#FFFFFF"><img src="images/spacer.gif" width="1" height="1" /></td>
  </tr>
  <tr>
    <td colspan="3"  height="20">&nbsp;&nbsp;&nbsp;&nbsp;<a href="news_list.php" class="menu_white">Article List</a></td>
  </tr> 
  <?php }?>

  <tr>
    <td colspan="3" bgcolor="#FFFFFF"><img src="images/spacer.gif" width="1" height="1" /></td>
  </tr>
  <tr>
    <td height="20" colspan="3" class="blue_bar">&nbsp;<a href="faq_category_list.php?op=faq"><span class="blue_bar">Manage FAQ</span></a></td>
  </tr>
  <?php if($_SESSION['sess_op']=="faq"){?>
  <tr>
    <td colspan="3" bgcolor="#FFFFFF"><img src="images/spacer.gif" width="1" height="1" /></td>
  </tr>
  <tr>
    <td colspan="3"  height="20">&nbsp;&nbsp;&nbsp;&nbsp;<a href="faq_category_list.php" class="menu_white">FAQ Category List</a></td>
  </tr> 
  <tr>
    <td colspan="3" bgcolor="#FFFFFF"><img src="images/spacer.gif" width="1" height="1" /></td>
  </tr>
  <tr>
    <td colspan="3"  height="20">&nbsp;&nbsp;&nbsp;&nbsp;<a href="faq_list.php" class="menu_white">FAQ List</a></td>
  </tr> 
  <?php }?>

  <tr>
    <td colspan="3" bgcolor="#FFFFFF"><img src="images/spacer.gif" width="1" height="1" /></td>
  </tr>
  <tr>
    <td height="20" colspan="3" class="blue_bar">&nbsp;<a href="links_category_list.php?op=mnglnk"><span class="blue_bar">Manage Links</span></a></td>
  </tr>
  <?php if($_SESSION['sess_op']=="mnglnk"){?>
  <tr>
    <td colspan="3" bgcolor="#FFFFFF"><img src="images/spacer.gif" width="1" height="1" /></td>
  </tr>
  <tr>
    <td colspan="3"  height="20">&nbsp;&nbsp;&nbsp;&nbsp;<a href="links_category_list.php" class="menu_white">Links Category List</a></td>
  </tr> 
  <tr>
    <td colspan="3" bgcolor="#FFFFFF"><img src="images/spacer.gif" width="1" height="1" /></td>
  </tr>
  <tr>
    <td colspan="3"  height="20">&nbsp;&nbsp;&nbsp;&nbsp;<a href="link_list.php" class="menu_white">Links List</a></td>
  </tr> 
  <?php }?>

  <tr>
    <td colspan="3" bgcolor="#FFFFFF"><img src="images/spacer.gif" width="1" height="1" /></td>
  </tr>
  <tr>
    <td height="20" colspan="3" class="blue_bar">&nbsp;<a href="newsletter_list.php?op=mngnwl"><span class="blue_bar">Manage Newsletter</span></a></td>
  </tr>
  <?php if($_SESSION['sess_op']=="mngnwl"){?>
  <tr>
    <td colspan="3" bgcolor="#FFFFFF"><img src="images/spacer.gif" width="1" height="1" /></td>
  </tr>
  <tr>
    <td colspan="3"  height="20">&nbsp;&nbsp;&nbsp;&nbsp;<a href="newsletter_list.php" class="menu_white">Newsletter List</a></td>
  </tr> 
  <tr>
    <td colspan="3" bgcolor="#FFFFFF"><img src="images/spacer.gif" width="1" height="1" /></td>
  </tr>
  <tr>
    <td colspan="3"  height="20">&nbsp;&nbsp;&nbsp;&nbsp;<a href="newsletter_subscriber_list.php" class="menu_white">Newsletter Subscriber List</a></td>
  </tr> 

  <?php }?>

  <tr>
    <td colspan="3" bgcolor="#FFFFFF"><img src="images/spacer.gif" width="1" height="1" /></td>
  </tr>
  <tr>
    <td height="20" colspan="3" class="blue_bar">&nbsp;<a href="banner_right_list.php?op=mngbann"><span class="blue_bar">Manage Banners</span></a></td>
  </tr>
  <?php if($_SESSION['sess_op']=="mngbann"){?>
  <tr>
    <td colspan="3" bgcolor="#FFFFFF"><img src="images/spacer.gif" width="1" height="1" /></td>
  </tr>
  <tr>
    <td colspan="3"  height="20">&nbsp;&nbsp;&nbsp;&nbsp;<a href="banner_right_list.php" class="menu_white">Right Banner List</a></td>
  </tr> 
  <tr>
    <td colspan="3" bgcolor="#FFFFFF"><img src="images/spacer.gif" width="1" height="1" /></td>
  </tr>
  <tr>
    <td colspan="3"  height="20">&nbsp;&nbsp;&nbsp;&nbsp;<a href="banner_bottom_list.php" class="menu_white">Bottom Banner List</a></td>
  </tr> 
  <tr>
    <td colspan="3" bgcolor="#FFFFFF"><img src="images/spacer.gif" width="1" height="1" /></td>
  </tr>
  <tr>
    <td colspan="3"  height="20">&nbsp;&nbsp;&nbsp;&nbsp;<a href="banner_top_list.php" class="menu_white">Top Banner List</a></td>
  </tr> 
  <tr>
    <td colspan="3" bgcolor="#FFFFFF"><img src="images/spacer.gif" width="1" height="1" /></td>
  </tr>
  <tr>
    <td colspan="3"  height="20">&nbsp;&nbsp;&nbsp;&nbsp;<a href="banner_left_list.php" class="menu_white">Left Google Ad List</a></td>
  </tr> 
  <?php }?>

  <tr>
    <td colspan="3" bgcolor="#FFFFFF"><img src="images/spacer.gif" width="1" height="1" /></td>
  </tr>
  <tr>
    <td  height="20" colspan="3" class="blue_bar">&nbsp;<a href="edit_adminpassword_frm.php?op=Admin"><span class="blue_bar">Manage Admin Details</span></a></td>
  </tr>
  
  <?php if($_SESSION['sess_op']=="Admin"){?> 
  <tr>
    <td colspan="3" bgcolor="#FFFFFF"><img src="images/spacer.gif" width="1" height="1" /></td>
  </tr>
  <tr>
    <td  height="20" colspan="3" >&nbsp;&nbsp;&nbsp;&nbsp;<a href="edit_adminpassword_frm.php" class="menu_white">Change Password </a></td>
  </tr> 

  <!-- 
  <tr>
    <td colspan="3" bgcolor="#FFFFFF"><img src="images/spacer.gif" width="1" height="1" /></td>
  </tr>
  <tr>
    <td  height="20" colspan="3" >&nbsp;&nbsp;&nbsp;&nbsp;<a href="currency_frm.php" class="menu_white">Currency Settings </a></td>
  </tr> 
  -->

  <tr>
    <td colspan="3" bgcolor="#FFFFFF"><img src="images/spacer.gif" width="1" height="1" /></td>
  </tr>
  <tr>
    <td  height="20" colspan="3" >&nbsp;&nbsp;&nbsp;&nbsp;<a href="site_settings_frm.php" class="menu_white">Site Settings </a></td>
  </tr> 


  <?php }?>


  <tr>
    <td colspan="3" bgcolor="#FFFFFF"><img src="images/spacer.gif" width="1" height="1" /></td>
  </tr>
 
    
</table>	
