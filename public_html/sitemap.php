<?php
	require "./includes/application_top.php";
	$b_page='INDEX';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
<title><?php echo stripslashes($site_title)?> : <?php echo stripslashes($site_meta_title)?></title>
<meta name="description" content="<?php echo stripslashes($site_meta_desc)?>" />
<meta name="keywords" content="<?php echo stripslashes($site_meta_words)?>" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="robots" content="index, follow" />
<meta name="author" content="<?php echo stripslashes($site_meta_author)?>" />
<meta name="copyright" content="<?php echo stripslashes($site_meta_copyright)?>"/>

<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link href="css/update.css" rel="stylesheet" type="text/css" />
<?php include("i_javascripts.php"); ?>

<!Google Analytics Tracking Code>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-539505-2']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</head>
<body>

<?php include('i_top.php'); ?>


<div class="containit">
    <div class="all-bg">
        <div class="pad">
          <div class="leftside fl">
            <?php $leftside="inside"; include('i_leftside.php'); ?>
          </div>
          <div class="rightside fl">
                <img src="images/blank.gif" width="1" height="12" alt="" /><br/>
                <table cellpadding="0" cellspacing="0" width="100%">
                  <tr>
                    <td valign="top" width="451">
                       <div class="breadcrumbs"><a href="index.php">Home</a> > Site Map</div>
                       <h1>Site Map</h1>
                       <table width="100%" border="0" cellspacing="1" cellpadding="1">
                         <tr>
                           <td><a href="index.php"><strong>Home</strong></a></td>
                         </tr>
                         <tr>
                           <td><a href="mtb-see-all.php"><strong>Money Transfer Basics</strong></a> </td>
                         </tr>
						 <?php
							$sql_mtbcat="select * from yp_mtb where status='Active' order by rec_name";
							$res_mtbcat=executeQuery($sql_mtbcat);
						 ?>
                         <tr>
                           <td><table width="95%" border="0" align="right" cellpadding="0" cellspacing="0">
							 <?php
								while($lin_mtbcat=mysql_fetch_array($res_mtbcat)){
							 ?>		
                             <tr>
                               <td width="3%" valign="middle">&raquo;</td>
                               <td width="97%" valign="middle"><a href="<?php echo $non_secure_path."mtb/".$lin_mtbcat['rec_id']?>/"><?php echo stripslashes($lin_mtbcat['rec_name'])?></a></td>
                             </tr>
							 <?php }?>
                           </table></td>
                         </tr>
                         <tr>
                           <td><a href="learning-center.php?mp=LEARNINGCENTER"><strong>Learning Center</strong></a> </td>
                         </tr>
						 <?php
							$sql_lrncat="select * from yp_learning_category where status='Active' order by cat_name";
							$res_lrncat=executeQuery($sql_lrncat);
						 ?>
                         <tr>
                           <td><table width="95%" border="0" align="right" cellpadding="0" cellspacing="0">
							 <?php
								while($lin_lrncat=mysql_fetch_array($res_lrncat)){
							 ?>		
                             <tr>
                               <td width="3%" valign="middle">&raquo;</td>
                               <td width="97%" valign="middle"><a href="learning-center-see-all.php?cid=<?php echo $lin_lrncat['cat_id']?>"><?php echo stripslashes($lin_lrncat['cat_name'])?></a></td>
                             </tr>
							 <?php }?>
                           </table></td>
                         </tr>
						 <tr>
                           <td><a href="reviews.php?mp=REVIEWS"><strong>Reviews</strong></a></td>
                         </tr>
						 <?php
							$sql_procat="select * from yp_provider where status='Active' order by rec_name";
							$res_procat=executeQuery($sql_procat);
						 ?>
                         <tr>
                           <td><table width="95%" border="0" align="right" cellpadding="0" cellspacing="0">
							 <?php
								while($lin_procat=mysql_fetch_array($res_procat)){
							 ?>		
                             <tr>
                               <td width="3%" valign="middle">&raquo;</td>
                               <td width="97%" valign="middle"><a href="<?php echo $non_secure_path."provider/".$lin_procat['rec_id']?>/"><?php echo stripslashes($lin_procat['rec_name'])?></a></td>
                             </tr>
							 <?php }?>
                           </table></td>
                         </tr>
                         <tr>
                           <td><a href="compare.php?mp=COMPARESERVICES"><strong>Compare Services</strong></a> </td>
                         </tr>
                         <tr>
                           <td><a href="resources.php?mp=RESOURCES"><strong>Resources &amp; Tools</strong></a> </td>
                         </tr>
						 <?php
							$sql_rescat="select * from yp_resource_main where status='Active' order by rec_name";
							$res_rescat=executeQuery($sql_rescat);
						 ?>
                         <tr>
                           <td><table width="95%" border="0" align="right" cellpadding="0" cellspacing="0">
							 <?php
								while($lin_rescat=mysql_fetch_array($res_rescat)){
							 ?>		
                             <tr>
                               <td width="3%" valign="middle">&raquo;</td>
                               <td width="97%" valign="middle"><a href="resources-list1.php?rsid=<?php echo $lin_rescat['rec_id']?>"><?php echo stripslashes($lin_rescat['rec_name'])?></a></td>
                             </tr>
							 <?php }?>
                           </table></td>
                         </tr>
                         <tr>
                           <td>Forum</td>
                         </tr>
                         <tr>
                           <td><a href="faq.php"><strong>Help</strong></a></td>
                         </tr>
                         <tr>
                           <td><a href="news.php"><strong>News</strong></a></td>
                         </tr>
						 <?php
							$sql_nwscat="select * from yp_news_category where status='Active' order by cat_name";
							$res_nwscat=executeQuery($sql_nwscat);
						 ?>
                         <tr>
                           <td><table width="95%" border="0" align="right" cellpadding="0" cellspacing="0">
							 <?php
								while($lin_nwscat=mysql_fetch_array($res_nwscat)){
							 ?>		
                             <tr>
                               <td width="3%" valign="middle">&raquo;</td>
                               <td width="97%" valign="middle"><a href="news-see-all.php?cid=<?php echo $lin_nwscat['cat_id']?>"><?php echo stripslashes($lin_nwscat['cat_name'])?></a></td>
                             </tr>
							 <?php }?>
                           </table></td>
                         </tr>
                         <tr>
                           <td><a href="about.php"><strong>About Us</strong></a> </td>
                         </tr>
                         <tr>
                           <td><a href="contact.php"><strong>Contact Us</strong></a> </td>
                         </tr>
                         <tr>
                           <td><a href="terms.php"><strong>Terms of Use</strong></a></td>
                         </tr>
                         <tr>
                           <td><a href="links.php"><strong>Links</strong></a></td>
                         </tr>
						 <?php
							$sql_lnkcat="select * from yp_links_category where category_status='Active' order by category_name";
							$res_lnkcat=executeQuery($sql_lnkcat);
						 ?>
                         <tr>
                           <td><table width="95%" border="0" align="right" cellpadding="0" cellspacing="0">
							 <?php
								while($lin_lnkcat=mysql_fetch_array($res_lnkcat)){
							 ?>		
                             <tr>
                               <td width="3%" valign="middle">&raquo;</td>
                               <td width="97%" valign="middle"><a href="links.php?link_cat_id=<?php echo $lin_lnkcat['category_id']?>"><?php echo stripslashes($lin_lnkcat['category_name'])?></a></td>
                             </tr>
							 <?php }?>
                           </table></td>
                         </tr>
                      </table>                       


                    </td>
                    <td width="15"><img src="images/blank.gif" width="15" height="1" alt="" /></td>
                    <td valign="top">
                        <?php include('i_ads.php'); ?>
                    </td>
                  </tr>
                </table>
          </div>
          <div class="clear"></div>

        <br/>
        <img src="images/blank.gif" width="1" height="18" alt="" /><br/>
        </div>
    </div>
</div>

<?php include('i_footer.php'); ?>

</body>
</html>